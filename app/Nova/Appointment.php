<?php

namespace App\Nova;

use App\Nova\Actions\Approve;
use App\Nova\Actions\CreateRecord;
use App\Nova\Actions\Notify;
use Fourstacks\NovaCheckboxes\Checkboxes;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class Appointment extends Resource
{
    public static function availableForNavigation(Request $request)
    {
        if (auth()->user()->email == 'super@admin.com') {
            return true;
        }
        return auth()->user()->email_verified_at != null;
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Appointment::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public function title()
    {
        return $this->date;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        // 'id',
        'date',
        'time',
        'description',
    ];

    public static function indexQuery(NovaRequest $request, $query)
    {
        if (auth()->id() != 1) {
            return $query->whereUserId(auth()->id());
        }
        return $query;
    }

    public function authorizedToDelete(Request $request)
    {
        return auth()->id() == 1;
    }

    public function authorizedToUpdate(Request $request)
    {
        if (auth()->user()->id == 1) {
            return true;
        }

        return is_null($this->approved_at);
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        $sOptions = [
            "Headache" => "Headache",
            " Nausea" => " Nausea",
            " Dizziness" => " Dizziness",
            " Sensitivity to light" => " Sensitivity to light",
            " Blurred vision" => " Blurred vision",
            " Vomiting" => " Vomiting",
            " Loss of appetite" => " Loss of appetite",
            " Fever Sensations of being very warm or cold" => " Fever Sensations of being very warm or cold",
        ];
        $fields = [
            Boolean::make('Alert')->canSee(fn() => auth()->user()->email == 'super@admin.com')->exceptOnForms(),

            Image::make('Proof of Payment', 'proof_of_payment')->rules(['']),

            Text::make('Conference Link', function () {
                if (is_null($this->approved_at) || !is_null($this->doneAt)) {
                    return "<a href='javascript:alert('you appointment is not yet approved.');' class='btn btn-link' disabled> Join In</a>";
                }
                $link = "/redirect-link?link=$this->id";
                return "<a href='$link' class='btn btn-link'> Join In</a>";
            })->asHtml(),

            Date::make('Requested Date', 'created_at')
                ->sortable()
                ->exceptOnForms(),

            Date::make('Appointment Date', 'date')
                ->rules(['required', 'date', 'after:today'])
                ->sortable(),

            Select::make('Type')
                ->options([
                    'face to face' => 'face to face',
                    'online' => 'online',
                ]),

            Select::make('Time')
                ->help('Your appointment will start based on the time you choose.')
                ->options(fn() => \App\Models\Timeslot::get()->pluck('time', 'time')),

            Checkboxes::make('Symptoms')
                ->options($sOptions),

            Textarea::make('Others', 'description')
                ->alwaysShow(),
            Badge::make('Status', function () {
                if (is_null($this->approved_at)) {
                    return 'Not yet approved';
                }

                if (!is_null($this->paid_at)) {
                    return 'Paid';
                }

                return 'Approved';
            })->map([
                'Not yet approved' => 'danger',
                'Approved' => 'warning',
                'Paid' => 'success',
            ]),
        ];

        if (auth()->user()->email != 'super@admin.com') {
            $fields[] = BelongsTo::make('User', 'user', User::class)->exceptOnForms();
        } else {
            $fields[] = BelongsTo::make('User', 'user', User::class);
        }

        return $fields;
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        $qr = nova_get_setting('qr');
        $n = nova_get_setting('admin_mobile');
        return [

        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        $actions = [(new Notify)->canSee(fn() => auth()->id() == 1 && $this->approved_at == null)->showOnTableRow(fn() => auth()->id() == 1),
            (new Approve)->canSee(fn() => auth()->id() == 1 && $this->approved_at == null)->showOnTableRow(fn() => auth()->id() == 1)];

        if (auth()->id() == 1) {
            array_push($actions, (new CreateRecord)->showOnTableRow(fn() => auth()->id() == 1));
        }

        return $actions;
    }
}
