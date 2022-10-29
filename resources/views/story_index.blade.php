<x-layout>
    <h1 class="text-2xl font-bold text-center bg-gradient-to-r from-green-400 to-blue-500 py-2">
        STORY MODE
        <div class="text-center">
            <a href="/" class="btn btn-sm">back to home</a>
        </div>
        <form class="my-4 flex items-center justify-center">
            <input  name="keyword" value="{{request()->keyword}}" type="text" placeholder="Search story" class="p-2 w-4/12 text-center uppercase rounded">
            <button class="btn btn-primary rounded-md mx-2">SEARCH</button>
        </form>
    </h1>

    <div x-data="{storyMode:1}">
        <div class="text-center bg-gradient-to-r from-green-400 to-blue-500 ">
            <a href="#" x-on:click="storyMode = 1" x-bind:class="{'underline': storyMode == 1}">STORIES</a> |
            <a href="#" x-on:click="storyMode = 2" x-bind:class="{'underline': storyMode == 2}">OTHER STORIES</a>
        </div>

        <div x-show="storyMode == 1" class="pb-24 overflow-y-auto w-screen h-screen flex justify-center items-center bg-gradient-to-r from-green-400 to-blue-500 relative flex-wrap">
            @foreach ($adminStories as $story)
                <a class="w-1/2 md:w-2/12 h-60 border-2 mx-2 mb-8 block" href="/story-mode/{{$story->id}}">
                    <img src="/storage/{{$story->cover}}" alt="" class="h-full w-full object-fit">
                    <h2 class="text-center font-bold uppercase">{{$story->title}}</h2>
                </a>
            @endforeach
            @foreach ($adminScenes as $story)
                <a class="w-1/2 md:w-2/12 h-60 border-2 mx-2 mb-8 block" href="/scene/{{$story->id}}">
                    <img src="/storage/{{$story->cover}}" alt="" class="h-full w-full object-fit">
                    <h2 class="text-center font-bold uppercase">{{$story->title}}</h2>
                </a>
            @endforeach
        </div>
        <div x-show="storyMode == 2" class="pb-24 overflow-y-auto w-screen h-screen flex justify-center items-center bg-gradient-to-r from-green-400 to-blue-500 relative flex-wrap">
            @foreach ($otherStories as $story)
                <a class="w-1/2 md:w-2/12 h-60 border-2 mx-2 mb-8 block" href="/story-mode/{{$story->id}}">
                    <img src="/storage/{{$story->cover}}" alt="" class="h-full w-full object-fit">
                    <h2 class="text-center font-bold uppercase">{{$story->title}}</h2>
                </a>
            @endforeach
            @foreach ($otherScenes as $story)
                <a class="w-1/2 md:w-2/12 h-60 border-2 mx-2 mb-8 block" href="/scene/{{$story->id}}">
                    <img src="/storage/{{$story->cover}}" alt="" class="h-full w-full object-fit">
                    <h2 class="text-center font-bold uppercase">{{$story->title}}</h2>
                </a>
            @endforeach
        </div>
    </div>
</x-layout>
