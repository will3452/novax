@if (request()->prof_ratio == 'return_on_assets')
<div class="border-2  p-2 rounded text-xl font-bold">
    The Entity enjoyed {{\App\Accounting::getReturnOnEquity()}} % returns to th shareholdr investments.
@endif
