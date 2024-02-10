<div x-data="{isOpen: false, }">
    <div class="flex p-2 md:p-8 justify-between items-center">
        <div class="flex items-center font-custom">
            <img src="/logo.png" alt="" class="w-16 md:w-16 mr-2">
            <div>
                <h1 class="text-xs md:text-lg md:font-bold md:tracking-widest text-green-500">Cultural, Historical & Tourism Promotions Division</h1>
                <h1 class="text-xs font-thin text-gray-900 md:text-md md:font-bold md:tracking-wide ">City Of Parañaque</h1>
            </div>
        </div>
        <div class="hidden md:block">
                <a href="/" class=" p-4 tracking-widest hover:bg-gray-200">Home</a>
                <a href="/map" class=" p-4 tracking-widest hover:bg-gray-200">Map</a>
                <a href="/search" class=" p-4 tracking-widest hover:bg-gray-200">Tourist Attractions</a>
                <a href="/about" class=" p-4 tracking-widest hover:bg-gray-200">About</a>
        </div>
        <div class="block md:hidden">
            <button x-show="! isOpen" @click="isOpen = !isOpen" class="transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 transition md:w-12" viewBox="0 0 24 24"><path fill="none" stroke="#888888" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/></svg>
            </button>
            <button x-show="isOpen" @click="isOpen = !isOpen" class="transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 transition md:w-12" viewBox="0 0 24 24"><path fill="none" stroke="#888888" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m4.5 19.5l15-15m-15 0l15 15"/></svg>
            </button>
        </div>
    </div>
    <ul class="list-none text-center md:text-2xl" x-show="isOpen">
        <li>
            <a href="/" class=" p-4 tracking-widest hover:bg-gray-200">Home</a>
        </li>
        <li>
            <a href="/map" class="block my-2 p-4 tracking-widest hover:bg-gray-200">Map</a>
        </li>
        <li>
            <a href="/search" class="block my-2 p-4 tracking-widest hover:bg-gray-200">Tourist Attractions</a>
        </li>
        <li>
            <a href="/about" class="block my-2 p-4 tracking-widest hover:bg-gray-200">About</a>
        </li>
    </ul>
</div>