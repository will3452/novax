<div class="bg-white">
    <div class="flex justify-center p-4">
        <h1 class="text-2xl font-bold text-blue-800 flex">Pando T<x-logo /> DA</h1>
    </div>
    <div class="flex justify-center border-y bg-gray-100">
        <a href="/" class="font-thin mx-2 px-4 py-2 {{ route('welcome.page') == url()->current()  ? 'text-white bg-blue-800' : ''}}">Home</a>
        <a href="#about" class="font-thin mx-2 px-4 py-2">About</a>
        <a href="/booking" class="font-thin mx-2 px-4 py-2 {{ route('booking.page') == url()->current()  ? 'text-white bg-blue-800' : ''}}">Booking Form</a>
        @guest
        <a href="/app" class="font-thin mx-2 px-4 py-2">Login</a>
        <a href="/register" class="font-thin mx-2 px-4 py-2 {{ route('register.page') == url()->current()  ? 'text-white bg-blue-800' : ''}}">Register</a>
        @else 
        <a href="/app" class="font-thin mx-2 px-4 py-2">Dashboard</a>
        @endguest
    </div>
</div>