@if (request()->liquidity_ratio == 'acid_ratio')
<div class="border-2  p-2 rounded text-xl font-bold">
    @if (abs(\App\Accounting::getAcidRatio()) > 1)
        The Entity can pay for their current liabilities using their quick assets.
    @else
    The Entity cannot pay for their current liabilities using their quick assets.
    @endif
</div>
@endif
