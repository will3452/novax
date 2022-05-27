<?php

namespace App\Nova\Actions;

use App\AES128;
use App\Nova\Image;
use App\Helpers\Dicom;
use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\Boolean;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Crypt;

class Encrypt extends Action
{
    use InteractsWithQueue, Queueable;
    public function getImageFromDICOM($file)
    {
        return Dicom::convertDicom($file);
    }
    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $startTime = microtime(true);
        $file = $fields['path'];
        $file = $this->getImageFromDICOM($file);
        [$key, $path] = AES128::storeFile($file);
        $execution_time = microtime(true) - $startTime;
        Transaction::create([
            'user_id' => auth()->id(),
            'content' => $path,
            'execution_time' => $execution_time,
            'key' => Crypt::encryptString($key),
        ]);

        // return Action::download("/key?key=$key", "key.txt");
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            File::make('DICOM File to encrypt', 'path'),
        ];
    }
}
