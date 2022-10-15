<x-layout>
    <div class="w-screen h-screen flex justify-center items-center bg-gradient-to-r from-green-400 to-blue-500 relative">
        <div class="absolute top-2 right-2 text-right">
            <div class="mb-2">
                <a href="/register" class="border-1 py-1 px-2 rounded-full bg-gray-800 text-blue-200 font-bold">Sign Up</a>
            </div>

            <div class="mb-2">
                <a href="/admin" class="border-1 py-1 px-2 rounded-full bg-gray-800 text-blue-200 font-bold">Sign in</a>
            </div>
            <div class="mb-2">
                <a href="#add-story" class="border-1 py-1 px-2 rounded-full bg-gray-800 text-blue-200 font-bold">Add Story </a>
            </div>
        </div>
        <div class="mx-4 cursor-pointer hover:bg-blue-200 p-4 rounded">
            <img src="/read.png" alt="" class="block w-32 h-32">
            <h2 class="text-center font-bold uppercase">
                Story Mode
            </h2>
        </div>
        <div class="mx-4 cursor-pointer hover:bg-blue-200 p-4 rounded">
            <img src="/box.png" alt="" class="block w-32 h-32">
            <h2 class="text-center font-bold uppercase">
                Game Mode
            </h2>
        </div>
        <a href="/gallery" class="mx-4 cursor-pointer hover:bg-blue-200 p-4 rounded block">
            <img src="/frame.png" alt="" class="block w-32 h-32">
            <h2 class="text-center font-bold uppercase">
                Gallery
            </h2>
        </a>
    </div>
</x-layout>
