<x-layout>
    <h1 class="text-2xl font-bold text-center bg-gradient-to-r from-green-400 to-blue-500 py-4">
        QUIZ
        <div class="text-center">
            <a href="/" class="btn btn-sm">back to home</a>
        </div>
    </h1>
    <div class="pb-24 overflow-y-auto w-screen h-screen  justify-center  bg-gradient-to-r from-green-400 to-blue-500 relative flex-wrap">
        @foreach ($questions as $item)
            <div class="mx-4 bg-white p-4 rounded font-bold mb-2" x-data="{hide: true}">
                <h2 class="text-red-500">Question: {{$item->questions}}</h2>
                <h2 class="text-green-500">Correct Answer: <span x-show="!hide">{{$item->answer}}</span><button x-show="hide" x-on:click="hide = false" class="btn btn-xs btn-secondary">reveal answer</button> </h2>
            </div>
        @endforeach
    </div>
</x-layout>
