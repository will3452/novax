<?php

namespace App\Nova;

use Illuminate\Support\Str;
use Laravel\Nova\Fields\ID;
use App\Nova\Actions\Reject;
use Illuminate\Http\Request;
use App\Nova\Actions\Approve;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Hidden;
use App\Nova\Actions\MarkAsDone;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Currency;
use App\Nova\Actions\ApplyForLoan;
use Laravel\Nova\Fields\BelongsTo;
use App\Nova\Actions\UploadPayment;
use Laravel\Nova\Http\Requests\NovaRequest;

class Application extends Resource
{
    public static function authorizedToCreate(Request $request) {
        return false;
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        if (auth()->user()->type == \App\Models\User::TYPE_STUDENT) {
            return $query->whereUserId(auth()->id());
        }
        return $query;
    }

    public function authorizedToUpdate(Request $request) {

        if ($request->has('action')) return true;
        return false;
    }

    public function authorizedToDelete(Request $request) {
        return false;
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Application::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'reference';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'reference',
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
                ->exceptOnForms()
                ->sortable(),
            Badge::make('Status')
                ->map([
                    'DECLINED' => 'danger',
                    'FOR APPROVAL' => 'warning',
                    'DONE' => 'info',
                    'APPROVED' => 'success',
                ]),
            Text::make('Reference')
                ->exceptOnForms()
                ->sortable(),
            Hidden::make('user_id')
                ->default(fn () => auth()->id()),
            Hidden::make('reference')
                ->default(fn () => "LOAN-".Str::random(6)),
            BelongsTo::make('User', 'user', User::class)
                ->exceptOnForms(),
            Currency::make('Monthly Payable')
                ->exceptOnForms(),

            HasMany::make('Logs', 'logs', ApplicationLog::class),

            Currency::make('Remaining Balance', function () {
                $rm = ($this->monthly_payable * nova_get_setting('nmp', 6)) - \App\Models\Payment::whereNotNull('approved_at')->whereApplicationId($this->id)->sum('amount');
                return $this->status != 'DECLINED' ? $rm : '0';
            })
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
        return [
            ApplyForLoan::make()
                ->canSee(fn () => auth()->user()->type == \App\Models\User::TYPE_STUDENT)
                ->standalone(),
            UploadPayment::make()
                ->canSee(fn () => auth()->user()->type == \App\Models\User::TYPE_STUDENT),
            Approve::make()
                ->canSee(fn () =>auth()->user()->type == \App\Models\User::TYPE_ADMIN),
            Reject::make()
                ->canSee(fn () =>auth()->user()->type == \App\Models\User::TYPE_ADMIN),
            MarkAsDone::make()
            ->canSee(fn () =>auth()->user()->type == \App\Models\User::TYPE_ADMIN),
        ];
    }
}
