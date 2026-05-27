<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;

class InventoryAudit extends Resource
{
public static $group = "Records";
public static function label()
{
    return 'Audit Trail';
}

public static function singularLabel()
{
    return 'Audit Record';
}

    public static function availableForNavigation(Request $request)
    {
        return auth()->user()->role === \App\Models\User::ROLE_ADMIN;
    }
    public function authorizedToUpdate(Request $request)
    {
        if ($request->has('action')) return true;
        return false;
    }

    public static function authorizedToCreate(\Illuminate\Http\Request $request)
{
    return false;
}

    public function authorizedToDelete(Request $request)
    {
        if ($request->has('action')) return true;
        return false;
    }

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\InventoryAudit::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
{
    return [
        ID::make()->sortable(),

        Text::make('Card Name', 'card_name'),

        Text::make('Action'),

        Text::make('Changes', function () {

    $changes = $this->changes;

    if (is_string($changes)) {
        $changes = json_decode($changes, true);
    }

    if (!$changes || !is_array($changes)) {
        return '<span style="opacity:0.6;">No changes</span>';
    }

    $output = [];

    foreach ($changes as $field => $values) {

        if (isset($values['old']) && isset($values['new'])) {

            $old = $values['old'];
            $new = $values['new'];

            // Convert URLs into clickable labels
            if (filter_var($old, FILTER_VALIDATE_URL)) {
                $old = "<a href='{$old}' target='_blank' style='color:#60a5fa;'>Old</a>";
            }

            if (filter_var($new, FILTER_VALIDATE_URL)) {
                $new = "<a href='{$new}' target='_blank' style='color:#34d399;'>New</a>";
            }

            $output[] = "
                <div style='margin-bottom:4px;'>
                    <strong>" . ucfirst($field) . ":</strong>
                    <span>{$old}</span>
                    <span style='opacity:0.6;'>→</span>
                    <span>{$new}</span>
                </div>
            ";
        }
    }

    return implode('', $output);

})
->onlyOnIndex()
->sortable(false)
->asHtml(),

        BelongsTo::make('User', 'user', User::class),

        DateTime::make('Created At'),
    ];
}

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
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
        return [];
    }
    public static function authorizedToViewAny(Request $request)
{
    \Log::info('InventoryAudit::authorizedToViewAny - attempting to view InventoryAudit resource');
    return true;
}
}
