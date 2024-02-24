<x-layout>
    <div class="relative w-screen h-screen overflow-hidden bg-gray-100">
        <div class="flex justify-center py-4 bg-blue-100 block md:hidden">
            <img src="/alarm.png" class="md:hidden block w-20 h-20 mr-10" alt="">
        </div>
        <nav class="flex p-4 text-white bg-blue-400 items-center justify-center md:justify-start">
            <img src="/alarm.png" class="hidden md:block w-20 h-20 mr-10" alt="">
            <a href="#" class="md:text-2xl font-mono mx-4 border-b-2">Home</a>
            <a href="/news" class="md:text-2xl font-mono mx-4">News</a>
            <a href="/organization" class="md:text-2xl font-mono mx-4">Officers</a>
            <a href="/register" class="md:text-2xl font-mono mx-4">Account</a>
        </nav>
        <div class="hidden md:block w-screen h-screen bg-blue-900 absolute rotate-45 opacity-90" style="right: -50vw; top: -150vh; height: 100vw; "></div>
        <div class="z-10 hidden md:block w-screen h-screen bg-blue-900 absolute rotate-45 opacity-90" style="bottom: -100vh; left: -50vw;"></div>
        <div x-data="{token: null}" x-init="token = localStorage.getItem('police-emerge-token')" class="px-4 md:p-8 text-center md:text-left text-blue-900 z-10 relative">
            <h3 class="text-xl  md:text-4xl font-thin mt-8 md:mb-4">
                Welcome to
            </h3>
            <h1 class="text-4xl md:text-8xl font-bold text-900-900 mb-4">
                Police Emerge!
            </h1>
            <h4 class="font-thin md:text-xl">
                Instant Aid, Anytime, Anywhere: Your Lifesaving Web Application
            </h4>
            <a :href="token == null || token == '' ? '/home': '/anonymous'" class="bg-blue-900 px-4 py-2 md:inline-block block rounded-full mt-4 hover:bg-blue-900 text-white font-bold border-blue-900 border-4">
                REPORT
            </a>
        </div>
        <img src="/police.png" alt="" class="absolute z-0 top-40 opacity-50 md:left-20">
    </div>
</x-layout>
