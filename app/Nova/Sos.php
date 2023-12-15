<?php

namespace App\Nova;

use GeneaLabs\NovaMapMarkerField\MapMarker;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;

class Sos extends Resource
{

    public static $polling = true; 

    public static function singularLabel()
    {
        return 'SOS';
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Sos::class;

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
            Date::make('Date', 'created_at')
                ->sortable()
                ->exceptOnForms(),
            Text::make('Level', function () {
                $color = 'yellow'; 
                if ($this->level == 'Moderate') $color = 'orange'; 
                if ($this->level == 'Severe') $color = 'red'; 

                return "<div style='display:flex; align-items:center;'><span style='display:inline-block;width:25px; height:25px; border-radius:100%; border:1px solid #222; background:$color;' ></span> $this->level</div>"; 
            })
                ->asHtml(), 
            Select::make('Status')
                ->options([
                    'NEW' => 'NEW',
                    'ONGOING' => 'ONGOING',
                    'DONE' => 'DONE',
                ]),
            Text::make('Type'),
            Textarea::make('Message'),
            File::make('Voice Message', 'audio'), 
            
            MapMarker::make('Location')
                ->latitude('lat')
                ->longitude('lng'),
            Text::make('View Routes', function () {
                $lat = $this->lat;
                $lng = $this->lng;
                return "<a target='_blank' href='/routing/$lat/$lng'>View Routes</a>";
            })
                ->asHtml(),
            Hidden::make('user_id')
                ->default(function () {
                    return auth()->id();
                }),
            BelongsTo::make('User', 'user', User::class)->exceptOnForms(),
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
}
