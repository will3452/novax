@if (request()->liquidity_ratio == 'cash_ratio')
<div class="border-2  p-2 rounded text-xl font-bold">
    @if (abs(\App\Accounting::getCashRatio()) > 1)
        The Entity can pay for their current liabilities using their total cash.
    @else
        The Entity cannot pay for their current liabilities using their total cash.
    @endif
</div>
@endif
