<?php

namespace App\Nova\Actions;

use App\Models\Booking;
use App\Models\Service;
use Michielfb\Time\Time;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Carbon;

class RequestAppointment extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        Booking::create([
            'reference'   => Str::random(12),
            'patient_id'  => auth()->id(),
            'date'        => $fields['date'],
            'time'        => $fields['time'],
            'service_id'  => $fields['service_id'],
        ]);
    }

    /**
     * Get the fields available on the action.
     */
    public function fields()
    {
        return [
            Date::make('Date')
                ->rules(['required', 'date', 'after_or_equal:today']),

            Time::make('Time', 'time')
                ->withSeconds(false)
                ->withSteps(1)
                ->rules([
                    'required',
                    function ($attribute, $value, $fail) {
                        try {
                            $inputTime = Carbon::createFromFormat('H:i:s', $value);


                            // Get selected date from the request (Nova action fields)
                            $selectedDate = request()->date;

                            if ($selectedDate) {
                                $selectedDate = Carbon::parse($selectedDate);


                                // Only validate past times if the selected date is today
                                if ($selectedDate->isToday()) {
                                    // Normalize current time without seconds
                                    $currentTime = Carbon::now()->format('H:i:s');

                                    // Ensure the $value has only HH:mm, strip seconds if present
                                    $cleanTime = substr($value, 0, 5);

                                    $cTime = explode(":", $currentTime);
                                    $vTime = explode(":", $value);
                                    $cTime = intval(implode("", $cTime));
                                    $vTime = intval(implode("", $vTime));
                                    // Compare if input time is earlier than now
                                    if ($cTime > $vTime) {
                                        $fail('The time cannot be in the past.');
                                    }
                                }
                            }
                        } catch (\Exception $e) {
                            $fail('Invalid time format.');
                        }
                    },
                ]),

            Select::make('Service', 'service_id')
                ->options(Service::get()->pluck('name', 'id'))
                ->rules(['required']),
        ];
    }
}
