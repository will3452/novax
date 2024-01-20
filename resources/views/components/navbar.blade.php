<div x-data="{isOpen: false, }">
    <div class="flex p-2 justify-between items-center">
        <img src="/logo.png" alt="" class="w-16">
        <div>
            <button x-show="! isOpen" @click="isOpen = !isOpen">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="none" stroke="#888888" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/></svg>
            </button>
            <button x-show="isOpen" @click="isOpen = !isOpen">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="none" stroke="#888888" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m4.5 19.5l15-15m-15 0l15 15"/></svg>
            </button>
        </div>
    </div>
    <ul class="list-none" x-show="isOpen">
        <li>
            <a href="" class="block my-2 p-2 tracking-widest hover:bg-gray-200">Home</a>
        </li>
        <li>
            <a href="" class="block my-2 p-2 tracking-widest hover:bg-gray-200">Map</a>
        </li>
        <li>
            <a href="" class="block my-2 p-2 tracking-widest hover:bg-gray-200">Tourist Attractions</a>
        </li>
        <li>
            <a href="" class="block my-2 p-2 tracking-widest hover:bg-gray-200">About</a>
        </li>
        <li>
            <a href="#" class="block my-2 p-2 tracking-widest hover:bg-gray-200">Contacts</a>
        </li>
    </ul>
</div>