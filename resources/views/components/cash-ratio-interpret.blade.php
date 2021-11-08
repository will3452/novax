@if (request()->liquidity_ratio == 'cash_ratio')
<div class="border-2  p-2 rounded text-xl font-bold">
    @if (\App\Accounting::getCashRatio() > 1)
        The Entity can pay for their current liabilities using their total cash since the ratio is greater than 1.
    @else
    The Entity cannot pay for their current liabilities using their total cash since the ratio is not greater than 1.
    @endif
</div>
@endif
