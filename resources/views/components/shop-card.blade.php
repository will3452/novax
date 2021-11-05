@props(['logo'=>null, 'location'=>null, 'shop'=>null])
<a href="/shops/{{$shop->id}}"class="block p-3 flex-none md:w-1/4 w-1/2 h-60 cursor-pointer ">

    <div class=" h-full w-full shadow-md border border-blue-500 relative bg-white rounded-md overflow-hidden"
    style="
        background:url('/storage/{{$shop->clean_logo}}');
        background-position:center;
        background-size:cover;
        "
    >
        @if ($shop->status == \App\Models\Shop::STATUS_CLOSED)
            <div class="absolute top-0 left-0 right-0 h-6 text-center uppercase font-bold bg-red-500 text-white text-xs pt-1">
                closed
            </div>
        @endif
        <div class="absolute bottom-0 left-0 right-0 h-10 bg-blue-500 text-white text-xs p-1"
        >

            <div class="flex justify-between">
                <div>
                    {{$shop ? \Str::limit($shop->description, 13): '---'}}
                </div>
                {{-- <div>
                    {{$shop ? ($shop->stars ?$shop->stars: 5 ): '---'}} stars
                </div> --}}
            </div>
            @if ($location)
                <div>
                    {{$location}} km
                </div>
            @endif
        </div>
    </div>
</a>
