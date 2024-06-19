<?php

namespace App\Nova;

use Eminiarts\Tabs\Tab;
use Eminiarts\Tabs\Tabs;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\HasMany;
use App\Nova\Actions\AddPanellist;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\MorphMany;
use App\Models\Group as ModelsGroup;
use App\Nova\Actions\ReadyForDenfense;
use App\Nova\Actions\MoveToDeanApproval;
use App\Nova\Actions\MarkAsReadyForDefence;
use App\Nova\Actions\MarkAsReadyForDefense;
use Laravel\Nova\Http\Requests\NovaRequest;
use App\Nova\Actions\MoveToPanellistApproval;
use App\Nova\Actions\SubmitOralDefenseRequest;
use App\Models\GroupMember as ModelGroupMember;
use App\Nova\Actions\MoveToCoordinatorApproval;
use App\Nova\Actions\ViewAcceptanceOfAdviserAndPanelMembersForm;
use App\Nova\Actions\ViewRequirementsForRevisionForm;
use App\Nova\Filters\GroupFilter;
use KirschbaumDevelopment\NovaComments\Commenter;
use KirschbaumDevelopment\NovaComments\CommentsPanel;

class Group extends Resource
{
    public static function group()
    {
        if (auth()->user()->isStudent()) return "Class"; 
        return "Manage"; 
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        if (auth()->user()->isStudent()) {
            $groups = ModelGroupMember::whereStudentId(auth()->id())->get()->pluck('group_id'); 
            return $query->whereIn('id', $groups); 
            // return $query->whereStatus('Ongoing')->whereIn('id', $groups); 
        }
        return $query;
    }

    public static function authorizedToCreate(Request $request)
    {
        if ($request->has('action')) return true; 
        return false; 
    }

    public function authorizedToUpdate(Request $request)
    {
        if ($request->has('action')) return true; 
        return false; 
    }

    public function authorizedToDelete(Request $request)
    {
        return false; 
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Group::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'code';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'title_id', 
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
            Tabs::make('Group', [
                Tab::make('Information', [
                    Date::make('Date', 'created_at')
                        ->sortable()
                        ->exceptOnForms(), 
                    Text::make('Group code', 'code')
                        ->exceptOnForms(), 
                        
            
                    BelongsTo::make('Title', 'title', Title::class),
                    Select::make('Status')
                        ->options([
                            ModelsGroup::ADD_PANELIST => ModelsGroup::ADD_PANELIST,
                            ModelsGroup::FOR_PANEL_APPROVAL => ModelsGroup::FOR_PANEL_APPROVAL,
                            ModelsGroup::FOR_COORDINATOR_APPROVAL => ModelsGroup::FOR_COORDINATOR_APPROVAL,
                            ModelsGroup::FOR_DEAN_APPROVAL => ModelsGroup::FOR_DEAN_APPROVAL,
                            ModelsGroup::FOR_DEFENSE => ModelsGroup::FOR_DEFENSE,
                            ModelsGroup::FINISHED => ModelsGroup::FINISHED,
                        ]),
                    Date::make('Defense Schedule'), 
                ]),
                Tab::make('Students', [
                    HasMany::make('Group Member', 'groupMembers', GroupMember::class), 
                ]), 
                Tab::make('Panelists', [
                    HasMany::make('Panellists', 'panellists', Panellist::class)
                ]),
                Tab::make('Progress ', [
                    HasMany::make('Progress Reports', 'progresses', Progress::class), 
                ]),
                Tab::make('Oral Defense Requests ', [
                    HasMany::make('Oral Defense Request', 'oralDefenseRequests', OralDefenseRequest::class), 
                ]),
                Tab::make('Revisions', [
                    HasMany::make('Revisions', 'revisions', Revision::class), 
                ]),
            ])->withToolbar(),
            MorphMany::make(
                'Comments',
                'comments',
                \KirschbaumDevelopment\NovaComments\Nova\Comment::class
            )->onlyOnForms(),
            Commenter::make(), 
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
        return [
            GroupFilter::make()->canSee(fn() => auth()->user()->isFaculty()),
        ];
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
        $actions = [
            MarkAsReadyForDefense::make()->canSee(fn () => auth()->user()->isFaculty() && $this->defense_schedule == null),
            MoveToDeanApproval::make()->canSee(function () {
                return auth()->user()->isFaculty(); 
            }),
            ViewAcceptanceOfAdviserAndPanelMembersForm::make(), 
            ViewRequirementsForRevisionForm::make(), 
        ]; 
        if ($request->action == 'mark-as-ready-for-defense') {
            return [MarkAsReadyForDefense::make(), 
            ViewAcceptanceOfAdviserAndPanelMembersForm::make(), 
            ViewRequirementsForRevisionForm::make(), 
        ]; 
        }
        if ($this->code == null) {
            return [
                ViewAcceptanceOfAdviserAndPanelMembersForm::make(), 
                ViewRequirementsForRevisionForm::make(), 
                AddPanellist::make()->canSee(fn () => auth()->user()->isFaculty()), 
                MoveToPanellistApproval::make()->canSee(fn () => auth()->user()->isFaculty()), 
                MoveToCoordinatorApproval::make()->canSee(function () {
                    $visible = true; 
                    foreach($this->panellists as $p) {
                        if ($p->status == 'PENDING') $visible = false; 
                    }
                    return $visible && auth()->user()->isFaculty(); 
                }),
                MoveToDeanApproval::make()->canSee(fn () => auth()->user()->isFaculty()), 
            ];
        }
        return $actions; 
    }
}
