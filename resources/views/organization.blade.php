<x-layout>
    <x-topbar></x-topbar>
    <div class="w-screen flex overflow-auto" style="height: 90vh; ">
        <div class="md:w-2/3 w-full h-screen overflow-y-auto">
            <h1 class="p-4 bg-blue-400  font-bold text-2xl uppercase font-mono text-white text-center md:text-left flex items-center">
                <span class="material-symbols-outlined">
                    group
                    </span>
                    </span>
             Organizations</h1>
             <div class="p-5 h-full" id="org">
                <input class="search border-2 p-2 rounded-xl" placeholder="Search Officer" />
                <button class="sort bg-gray-200 rounded-xl p-2 font-bold text-xs" data-sort="name">Sort by Name</button>
                <button class="sort  bg-gray-200 rounded-xl p-2 font-bold text-xs" data-sort="position">Sort by Position</button>
                <button class="sort  bg-gray-200 rounded-xl p-2 font-bold text-xs" data-sort="designation">Sort by Designation</button>
                <div class="list">
                    @foreach (\App\Models\Organization::get() as $item)
                        <div class="p-4 bg-blue-900 my-4 rounded flex">
                            <img src="/storage/{{$item->image}}" alt="" class="w-40">
                            <div class="mx-4 font-bold text-white">
                                <div class="name">Name: {{$item->name}}</div>
                                <div class="position">Position: {{$item->position}}</div>
                                <div class="designation">Designation: {{$item->designation}}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
             </div>
        </div>
        <x-latest-news></x-latest-news>
    </div>
    <x-bottombar></x-bottombar>
    

    <script id="dsq-count-scr" src="//police-elezerk-net.disqus.com/count.js" async></script>
    <script>
        var options = {
            valueNames: [ 'name', 'position' , 'designation']
        };

        var org = new List('org', options);
    </script>
</x-layout>