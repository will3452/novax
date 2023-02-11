<?php

namespace App\Nova\Actions;

use App\Models\Profile;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;

class IssueDocument extends Action
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
            return Action::openInNewTab(route('issue', ['profile' => $model->id, 'document' => $fields['document']]));
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
            Select::make('Select Document', 'document')
                ->rules(['required'])
                ->options([
                    'CLEARANCE' => 'CLEARANCE',
                    // 'DEED OF SALE' => 'DEED OF SALE',
                    'BUSINESS PERMIT' => 'BUSINESS PERMIT',
                    'INDEGENT CERTIFICATE' => 'INDEGENT CERTIFICATE'
                ])
        ];
    }
}
