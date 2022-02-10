<nav class="flex bg-black items-center justify-between shadow">
    <img src="/bru_assets/textlogo.png" alt="text logo" style="width:300px;">
    <ul class="text-white flex items-center">
        <x-home-nav-link href="/" :isActive="url()->current() === route('welcome')">
            Home
        </x-home-nav-link>
        <li class="mx-4 inline-block uppercase font-bold px-4 py-2">
            <a href="/about">
                About
            </a>
        </li>
        <li class="mx-4 inline-block uppercase font-bold px-4 py-2">
            <a href="/contact">
                Contact
            </a>
        </li>
        <li class="mx-4 inline-block uppercase font-bold px-4 py-2">
            <a href="/contact">
                Sign Up
            </a>
        </li>
        <li class="mx-4 inline-block uppercase font-bold px-4 py-2">
            <a href="/contact">
                Sign In
            </a>
        </li>
    </ul>
</nav>
