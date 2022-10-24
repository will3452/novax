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

    <div class="text-center bg-gradient-to-r from-green-400 to-blue-500 ">
        <a href="">STORIES</a> |
        <a href="">AUTHORS STORIES</a>
    </div>

    <div class="bg-gradient-to-r from-green-400 to-blue-500 p-4">
        {{$stories->links()}}
    </div>
    <div class="pb-24 overflow-y-auto w-screen h-screen flex justify-center items-center bg-gradient-to-r from-green-400 to-blue-500 relative flex-wrap">
        @foreach ($stories as $story)
            <a class="w-1/2 md:w-2/12 h-60 border-2 mx-2 mb-8 block" href="/story-mode/{{$story->id}}">
                <img src="/storage/{{$story->cover}}" alt="" class="h-full w-full object-fit">
                <h2 class="text-center font-bold uppercase">{{$story->title}}</h2>
            </a>
        @endforeach
    </div>
</x-layout>
