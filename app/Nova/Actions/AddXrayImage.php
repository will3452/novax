<?php

namespace App\Nova\Actions;

use App\AES128;
use App\Helpers\Dicom;
use App\Models\Image;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\File;

class AddXrayImage extends Action
{
    use InteractsWithQueue, Queueable;

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
            if ($fields['dicom']) {
                $file = Dicom::convertDicom($file);
            }
            [$key, $path] = AES128::storeFile($file);
            Image::create([
                'model_type' => get_class($model),
                'model_id' => $model->id,
                'path' => $path,
                'key' => $key,
            ]);
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            File::make('File', 'path')
                ->rules(['required']),
            Boolean::make('DICOM', 'dicom'),
        ];
    }
}
