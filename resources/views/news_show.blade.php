<x-layout>
    <x-topbar></x-topbar>
    <div class="w-screen flex overflow-auto" style="height: 90vh; ">
        <div class="md:w-2/3 w-full h-screen overflow-y-auto">
            <h1 class="p-4 bg-blue-400  font-bold text-2xl uppercase font-mono text-white text-center md:text-left flex items-center justify-between">
                <span>
                    <span class="material-symbols-outlined">
                        info
                        </span>
                 {{$post->title}}
                
                </span>
                
                <span class="hidden md:block">
                    {{$post->created_at}}
                </span>
            </h1>
             <div class="p-5" id="news">
                <p>
                    @foreach (explode(",", $post->tags) as $i)
                        <a href="#" class="font-bold">#{{$i}}</a>
                    @endforeach
                </p>
                <p class="text-xl font-mono">
                    {{$post ->body}}
                </p>
                <a href="/news" class="underline text-blue-500 mt-5 block">Go back to newsfeed.</a>
             </div>
             <div id="disqus_thread" class="p-4"></div>
        <script>
            var disqus_config = function () {
                this.page.url = '{{  url()->current() }}';  // Replace PAGE_URL with your page's canonical URL variable
                this.page.identifier = 'news-{{$post->id}}'; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
            };
            (function() { // DON'T EDIT BELOW THIS LINE
            var d = document, s = d.createElement('script');
            s.src = 'https://police-elezerk-net.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
            })();
        </script>
        <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
        </div>
        <x-latest-news></x-latest-news>
    </div>
    <x-bottombar></x-bottombar>

    <script>
        var options = {
            valueNames: [ 'title', 'body' , 'created_at']
        };

        var news = new List('news', options);
    </script>
</x-layout>