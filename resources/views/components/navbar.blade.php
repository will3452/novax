<div class="bg-white">
    <div class="flex justify-center p-4">
        <h1 class="text-2xl font-bold text-blue-800 flex">M<x-logo />YKAN</h1>
    </div>
    <div class="flex md:justify-center border-y bg-gray-100 flex-nowrap w-screen overflow-x-auto ">
        <a href="/" class="block font-thin mx-2 px-8 py-2 {{ route('welcome.page') == url()->current()  ? 'text-white bg-blue-800' : ''}}">Home</a>
        <a href="/#about" class="block font-thin mx-2 px-8 py-2">About</a>
        <a href="/booking" class="block font-thin mx-2 px-8 py-2 {{ route('booking.page') == url()->current()  ? 'text-white bg-blue-800' : ''}}">Booking</a>
        @guest
        <a href="/login" class="block font-thin mx-2 px-8 py-2 {{ route('login') == url()->current()  ? 'text-white bg-blue-800' : ''}}">Login</a>
        <a href="/register" class="block font-thin mx-2 px-8 py-2 {{ route('register.page') == url()->current()  ? 'text-white bg-blue-800' : ''}}">Register</a>
        @else 
        <a href="/app" class="block font-thin mx-2 px-8 py-2">Dashboard</a>
        @endguest
    </div>
</div>