@if (request()->liquidity_ratio == 'current_ratio')
<div class="border-2  p-2 rounded text-xl font-bold">
    @if (abs(\App\Accounting::getCurrentRatio()) > 1)
        The Entity can pay for their current liabilities using their current assets.
    @else
        The Entity cannot pay for their current liabilities using their current assets.
    @endif
</div>
@endif
