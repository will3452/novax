<div class="md:w-1/3 hidden md:block bg-gray-200 ">
    <h1 class="p-4 bg-red-500  font-bold text-2xl  font-mono text-white flex items-center ">
        <div class="flex items-center uppercase">
            <span class="material-symbols-outlined ">
                newspaper
                </span> Latest News
        </div>
        <div class="font-mono text-sm">
            &nbsp; as of {{ Date::now()->format('M d, Y') }}
        </div>
    </h1>
    <div class="px-4 overflow-y-scroll h-full">
        @foreach (\App\Models\News::latest()->take(6)->get() as $item)
            <x-news-card :item="$item"></x-news-card>
            @if ($loop->last)
                <div class="my-20">

                </div>
            @endif
        @endforeach
    </div>
</div>