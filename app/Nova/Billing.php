<?php

namespace App\Nova;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Textarea;
use App\Models\User as ModelsUser;
use App\Nova\Actions\PayNow;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;

class Billing extends Resource
{

    public static function indexQuery(NovaRequest $request, $query)
    {
        if (auth()->user()->type == 'Patient') {
            return $query->wherePayeeId(auth()->id());
        }
        return $query;
    }

    public static function group () {
        return auth()->user()->type == ModelsUser::TYPE_STAFF ? 'CASHIER' : 'PAYMENTS';
    }

    public function authorizedToView(Request $request)
    {
        return in_array(auth()->user()->type, [ModelsUser::TYPE_ADMIN, ModelsUser::TYPE_STAFF]);
    }
    public static function authorizedToCreate(Request $request)
    {
        return in_array(auth()->user()->type, [ModelsUser::TYPE_ADMIN, ModelsUser::TYPE_STAFF]);
    }
    public function authorizedToDelete(Request $request)
    {
        return in_array(auth()->user()->type, [ModelsUser::TYPE_ADMIN, ModelsUser::TYPE_STAFF]);
    }

    public function authorizedToUpdate(Request $request)
    {
        if ($request->action == 'pay-now') {
            return true;
        }
        return in_array(auth()->user()->type, [ModelsUser::TYPE_ADMIN, ModelsUser::TYPE_STAFF]);
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Billing::class;

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
            Date::make('Date', 'created_at')->sortable(),
            Textarea::make('Particulars')
                ->alwaysShow()
                ->showOnIndex(),
            Currency::make('Amount')
                ->rules(['required', 'min:1']),
            Currency::make('Balance', function (){
                $total = 0;
                foreach($this->payments as $payment) {
                    $total += $payment->amount;
                }
                $balance = $this->amount - $total;
                return $balance <= 0 ? 0: $this->amount - $total;
            }),
            Text::make('Status', function () {
                $total = 0;
                foreach($this->payments as $payment) {
                    $total += $payment->amount;
                }
                $balance = $this->amount - $total;
                return $balance <= 0 ? "<span class='text-green-900 bg-green-200 p-2 rounded-2xl font-bold'>Paid</span>": "<span class='text-red-900 bg-red-200 p-2 rounded-2xl font-bold'>Awaiting Payment</span>";
            })->asHtml(),
            BelongsTo::make('Payee', 'payee', User::class)
                ->showCreateRelationButton(),
            Select::make('Mode')
                ->options(['Cash' => 'Cash', 'Check' => 'Check']),
            Text::make('Bank/Check #', 'bank'),
            HasMany::make('Payments', 'payments', Payment::class),
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
            PayNow::make()->canSee(function () {
                if (auth()->user()->type != 'Patient') return false;
                if ($this->id) {
                    $billing = \App\Models\Billing::find($this->id);
                    $paid = $billing->payments()->sum('amount');
                    return $billing->amount > $paid;
                }
                return true;
            }),
        ];
    }
}
