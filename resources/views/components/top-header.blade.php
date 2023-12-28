<div 
class=" bg-dark"
x-data="{
    isMenuOpen: false, 
}">
    
<header class="p-2 flex items-center h-16 md:h-32 justify-between md:justify-center">
    <img src="/logo.png" alt="" class="h-8 md:h-16">
    <div x-show="!isMenuOpen" class="transition hover:scale-110 md:hidden">
        <button  @click="isMenuOpen = ! isMenuOpen">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="#F6A757" d="M3 6h18v2H3zm0 5h18v2H3zm0 5h18v2H3z"/></svg>
        </button>
    </div>
    <div x-show="isMenuOpen" class="transition hover:scale-110 md:hidden">
    <button @click="isMenuOpen = ! isMenuOpen">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="#F6A757" d="M19 6.41L17.59 5L12 10.59L6.41 5L5 6.41L10.59 12L5 17.59L6.41 19L12 13.41L17.59 19L19 17.59L13.41 12z"/></svg>
    </button>
    </div>
</header>
<template x-if="isMenuOpen">
    <ul class="bg-primary">
        <li class="hover:bg-orange-600 p-2 text-center font-serif">
            <a href="#">About Us</a>
        </li>
        <li class="hover:bg-orange-600 p-2 text-center font-serif">
            <a href="#">Our Services & Products</a>
        </li>
        <li class="hover:bg-orange-600 p-2 text-center font-serif">
            <a href="#">Contact Us</a>
        </li>
    </ul>
</template>
</div>
<div class="md:flex justify-center hidden bg-primary text-center text-white text-xl font-serif">
    <a href="" class="block p-4 px-8">About Us</a>
    <a href="" class="block p-4 px-8">Product & Services</a>
    <a href="" class="block p-4 px-8">Contact Us</a>
</div>