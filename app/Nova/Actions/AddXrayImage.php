<?php

namespace App\Nova\Actions;

use App\AES128;
use App\Models\Image;
use App\Helpers\Dicom;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\Boolean;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Crypt;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddXrayImage extends Action
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
        foreach ($models as $model) {
            $file = $fields['path'];
            $file = $this->getImageFromDICOM($file);
            [$key, $path] = AES128::storeFile($file);
            Image::create([
                'model_type' => get_class($model),
                'model_id' => $model->id,
                'path' => $path,
                'key' => Crypt::encryptString($key),
            ]);
        }
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
