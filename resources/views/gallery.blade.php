<x-layout>
    <div class="overflow-y-auto w-screen h-screen flex justify-center  bg-gradient-to-r from-green-400 to-blue-500 relative">
        <div>
            <div class="mb-5">
                <h1 class="text-center text-4xl uppercase mt-2 font-mono">Gallery</h1>
                <div class="text-center">
                    <a href="/" class="btn btn-sm">back to home</a>
                </div>
            </div>
            <div class="flex items-center flex-wrap justify-center">
                @foreach ($gallery as $item)
                    <img class="block w-4/12 mx-2" src="/storage/{{$item->picture}}" alt="">
                @endforeach
            </div>
        </div>
    </div>

</x-layout>
