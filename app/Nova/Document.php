<?php

namespace App\Nova;

use App\Models\User as UserModel;
use Pdmfc\NovaCards\Info;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\HasMany;
use Comodolab\Nova\Fields\Help\Help;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Http\Requests\NovaRequest;
use KirschbaumDevelopment\NovaComments\Commenter;
use DigitalCreative\ResourceNavigationTab\CardMode;
use KirschbaumDevelopment\NovaComments\CommentsPanel;
use DigitalCreative\ResourceNavigationTab\ResourceNavigationTab;
use DigitalCreative\ResourceNavigationTab\HasResourceNavigationTabTrait;

class Document extends Resource
{
    use HasResourceNavigationTabTrait;

    public static function indexQuery(NovaRequest $request, $query)
    {
        if (auth()->user()->type == UserModel::TYPE_ADMINISTRATOR) {
            return $query;
        }

        $documents = auth()->user()->participantDocuments()->get()->pluck('id')->all();

        return $query->whereIn('id', $documents);
    }

    public static function authorizedToCreate(Request $request)
    {
        return auth()->user()->type == UserModel::TYPE_ADMINISTRATOR;
    }

    public  function authorizedToUpdate(Request $request)
    {
        return auth()->user()->type == UserModel::TYPE_ADMINISTRATOR;
    }

    public  function authorizedToDelete(Request $request)
    {
        return auth()->user()->type == UserModel::TYPE_ADMINISTRATOR;
    }

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Document::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name',
        'created_at',
    ];

    public static function createButtonLabel()
    {
        return 'Upload document';
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ResourceNavigationTab::make([
                'label' => 'Document Information',
                'behaveAsPanel' => false,
                'fields' => [
                    Help::make('Reminders: ')->warning($this->warnings)->canSee(fn () => $this->warnings != '')->exceptOnForms(),
                    Date::make('Date', 'created_at')->exceptOnForms()->sortable(),
                    Text::make('Name')
                        ->rules(['required']),
                    Select::make('Category')
                        ->options(\App\Models\Category::get()->pluck('name', 'name')),
                    File::make('File')
                        ->rules(['max:3000', 'required'])
                        ->canSee(fn () => auth()->user()->type == UserModel::TYPE_ADMINISTRATOR),
                    File::make('File')
                        ->rules(['max:3000', 'required'])
                        ->disableDownload()
                        ->canSee(fn () => auth()->user()->type == UserModel::TYPE_BASIC),
                    Hidden::make('user_id')->default(fn () => auth()->id()),
                    Badge::make('Status')->map(['RESOLVED' => 'success', 'PENDING' => 'info']),
                    (new Commenter()),
                ],
            ]),
            ResourceNavigationTab::make([
                'label' => 'Participants',
                'behaveAsPanel' => true,
                'fields' => [ BelongsToMany::make('Participants', 'participants', User::class),]
            ])->canSee(fn () => auth()->user()->type == \App\Models\User::TYPE_ADMINISTRATOR),
            ResourceNavigationTab::make([
                'label' => 'Meeting Links',
                'behaveAsPanel' => true,
                'fields' => [
                    HasMany::make('Links', 'links', Link::class),
                ]
                ]),
            ResourceNavigationTab::make([
                'label' => 'Activities',
                'behaveAsPanel' => true,
                'fields' => [
                    HasMany::make('Activities', 'activities', Activity::class),
                    (new CommentsPanel()),
                ]
            ]),

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
        return [];
    }
}
