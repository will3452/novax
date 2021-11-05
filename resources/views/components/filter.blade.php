@if (request()->lat && request()->lng)
    <div class="w-full flex justify-center md:justify-end p-2">
        <form action="/" class="flex items-end">
            <input type="hidden" name="lng" value="{{request()->lng}}">
            <input type="hidden" name="lat" value="{{request()->lat}}">
            @if (request()->keyword)
            <input type="hidden" name="keyword" value="{{request()->keyword}}">
            @endif
            <div class="mx-2">
                <label for="" style="font-size:8px;" class="block text-xs font-bold text-blue-500 uppercase">Limit</label>
                <select name="limit" id="" class="rounded-md text-xs font-bold border border-green-500 p-1">
                    <option value="10" {{request()->limit !=10?:'selected'}}>10</option>
                    <option value="50" {{request()->limit !=50?:'selected'}}>50</option>
                    <option value="100" {{request()->limit !=100?:'selected'}}>100</option>
                </select>
            </div>
            <div class="mx-2">
                <label for="" style="font-size:8px;" class="block text-xs font-bold text-blue-500 uppercase">Status</label>
                <select name="status" id="" class="rounded-md text-xs font-bold border border-green-500 p-1">
                    <option value="all" {{request()->status !='all'?:'selected'}}>All</option>
                    <option value="open" {{request()->status !='open'?:'selected'}}>OPEN</option>
                    <option value="closed" {{request()->status !='closed'?:'selected'}}>CLOSED</option>
                </select>
            </div>
            <button class="rounded-md text-xs p-1 bg-blue-500 text-white font-bold uppercase">
                Apply Filter
            </button>
        </form>
    </div>
@endif
