<?php

namespace App\Nova\Actions;

use App\AES128;
use App\Models\Transaction;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class Decrypt extends Action
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
        $startTime = microtime(true);
        $key = $fields['key'];

        $uploadedFile = AES128::saveFile(file_get_contents($fields['path']));
        // dd($uploadedFile);
        $aes = new AES128($key);
        $file = Storage::get('/public/' . $uploadedFile);
        // return Action::download($file, 'result.png');
        $result = $aes->decrypt($file);
        $path = AES128::saveFile($result, true);
        $execution_time = microtime(true) - $startTime;

        Transaction::create([
            'user_id' => auth()->id(),
            'content' => $path,
            'type' => Transaction::TYPE_DECRYPT,
            'execution_time' => $execution_time,
        ]);
        // return Action::download("/key?key=$key", "key.txt");
        // // $urlDownload = "data:image/jpeg;base64," . base64_encode(file_get_contents($img));
        // // return Action::redirect("/viewer?image=" . $urlDownload);
        // return response()->stream(function () use ($result) {
        //     $img = @imagecreatefromstring($result);
        //     imagejpeg($img);
        // }, 200, ['content-type' => 'image/jpeg', 'Content-Disposition' => 'attachment; filename="' . uniqid() . '".jpg']);
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [
            File::make('File to decrypt', 'path')
                ->acceptedTypes('.dat')
                ->rules(['required'])
                ->help('maximum of 5mb only. (.dat file)'),
            Text::make('Key')
                ->rules(['required', 'max:16']),
        ];
    }
}
