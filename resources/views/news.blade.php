<x-layout>
    <x-topbar></x-topbar>
    <div class="w-screen flex overflow-auto" style="height: 90vh; ">
        <div class="md:w-2/3 w-full h-screen overflow-y-auto">
            <h1 class="p-4 bg-blue-400  font-bold text-2xl uppercase font-mono text-white text-center md:text-left flex items-center">
                <span class="material-symbols-outlined">
                    clear_all
                    </span>
             All News</h1>
             <div class="p-5 h-full" id="news">
                <input class="search border-2 p-2 rounded-xl" placeholder="Search News" />
                <button class="sort bg-gray-200 rounded-xl p-2 font-bold text-xs" data-sort="title">Sort by Title</button>
                <button class="sort  bg-gray-200 rounded-xl p-2 font-bold text-xs" data-sort="body">Sort by Body</button>
                <button class="sort  bg-gray-200 rounded-xl p-2 font-bold text-xs" data-sort="created_at">Sort by Date</button>
                <div class="list">
                    @foreach ($news as $item)
                        <x-news-card :item="$item"></x-news-card>
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
            valueNames: [ 'title', 'body' , 'created_at']
        };

        var news = new List('news', options);
    </script>
</x-layout>