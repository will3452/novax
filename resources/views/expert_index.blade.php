<x-layout>
    <a href="" class=" block flex justify-center bg-white">
        <img class="w-20" src="{{nova_get_setting('logo') ? '/storage/' : ''}}{{nova_get_setting('logo')}}" alt="123123">
    </a>
    <h1 class="text-center uppercase my-4 font-bold tracking-widest text-2xl">
        {{count($experts) > 1 ? 'Experts' : 'Expert'}}
    </h1>
    @foreach ($experts as $expert)
        <div class="p-3 shadow m-3 mb-5 rounded bg-gray-200">
            <div class="flex justify-center">
                <img src="/storage/{{$expert->image}}" alt="" class="w-20 h-20 rounded-full object-cover">
            </div>
            <div class="text-center my-2">
                <h3 class="font-bold uppercase tracking-wider">
                    {{$expert->name}}
                </h3>
                <h4 class="text-sm font-bold text-gray-700">
                    {{$expert->title}}
                </h4>
            </div>
            <div x-data="{showMore:false}" class="border-red-500 p-3 text-sm border-l-4 relative">
                <div x-bind:class="{'h-16':!showMore}" class="overflow-hidden">
                    <div class="text-justify">
                        {!!\Str::of($expert->about)->markdown!!}
                    </div>
                    @if (count($expert->files))
                    <div class="bg-gray-300 p-2 rounded mt-6">
                        <h3 class="font-bold">Files & References</h3>
                        <ul class="list-disc">
                            @foreach ($expert->files as $file)
                                <li class="my-1">
                                    <a href="{{$file->file}}" target="_blank" class="justify-between font-bold flex block shadow bg-gray-400 p-2 rounded">{{$file->title}}
                                        <span class="font-thin text-xs uppercase underline">Browse</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
                <button x-on:click="showMore = !showMore" x-text="showMore ? 'Show Less': 'Read More'" class="shadow p-2 rounded-2xl absolute -bottom-7 right-0 bg-red-500 text-white text-xs uppercase font-bold">
                    read more
                </button>
            </div>
        </div>
    @endforeach
</x-layout>
