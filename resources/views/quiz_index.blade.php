<x-layout>
    <h1 class="text-2xl font-bold text-center bg-gradient-to-r from-green-400 to-blue-500 py-4">
        QUIZ
        <div class="text-center">
            <a href="/" class="btn btn-sm">back to home</a>
        </div>
    </h1>
    <form method="POST" action="/score/{{$story->id}}" class="pb-24 overflow-y-auto w-screen h-screen  justify-center  bg-gradient-to-r from-green-400 to-blue-500 relative flex-wrap" x-data="{hide: true}">
        @csrf
        @foreach ($questions as $item)
            <div class="mx-4 bg-white p-4 rounded font-bold mb-2" >
                <h2 class="text-red-500">Question: {{$item->questions}}</h2>
                <input type="text" name="answer[{{$loop->index}}]" class="border input input-bordered input-sm mt-2" placeholder="Enter answer here">
                {{-- <h2 class="text-green-500">Correct Answer: <span x-show="!hide">{{$item->answer}}</span><button x-show="hide" x-on:click="hide = false" class="btn btn-xs btn-secondary">reveal answer</button> </h2> --}}
            </div>
        @endforeach
        <button class="mx-4 btn btn-block">SUBMIT</button>
    </form>
</x-layout>
