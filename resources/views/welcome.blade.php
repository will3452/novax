<x-layout>
    <div class="relative w-screen h-screen overflow-hidden">
        <div class="flex justify-center py-4 bg-red-100 block md:hidden">
            <img src="/alert.png" class="md:hidden block w-20 h-20 mr-10" alt="">
        </div>
        <nav class="flex p-4 text-white bg-green-400 items-center justify-center md:justify-start">
            <img src="/alert.png" class="hidden md:block w-20 h-20 mr-10" alt="">
            <a href="" class="md:text-2xl font-mono mx-4 border-b-2">Home</a>
            <a href="" class="md:text-2xl font-mono mx-4">News</a>
            <a href="" class="md:text-2xl font-mono mx-4">Officers</a>
            <a href="" class="md:text-2xl font-mono mx-4">Account</a>
        </nav>
        <div class="hidden md:block w-screen h-screen bg-red-500 absolute rotate-45 opacity-90" style="right: -50vw; top: -150vh; height: 100vw; "></div>
        <div class="hidden md:block w-screen h-screen bg-red-500 absolute rotate-45 opacity-90" style="bottom: -100vh; left: -50vw;"></div>
    </div>
</x-layout>
