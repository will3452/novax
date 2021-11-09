@if (request()->prof_ratio == 'return_on_equity')
<div class="border-2  p-2 rounded text-xl font-bold">
    The Entity enjoyed {{number_format(\App\Accounting::getReturnOnEquity(),2)}} % returns to th shareholder investments.
@endif
