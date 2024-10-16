<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <link rel="icon" type="image/svg+xml" href="/storage/{{nova_get_setting('logo',)}}" />
  <title>{{env('APP_NAME')}}</title>
</head>
<body class="bg-gray-100 relative">
  <div class="bg-white sticky top-0" x-data="{ openMenu: false }">
    <div class="px-4 items-center justify-between hidden md:flex">
        <img src="/storage/{{nova_get_setting('logo')}}" alt="" class="w-[50px]">
        <div class="flex gap-2">
            @guest
                <a href="/login" class="border border-[#0B6477] px-4 py-2 bg-[#0B6477] text-white">Login</a>
                <a href="/register" class="border border-[#0B6477] px-4 py-2">Register</a>
            @else
                <a href="/home" class="">Appointment</a>
            @endguest
        </div>
    </div>
    <div class="px-4 flex items-center justify-between md:hidden">
        <img src="/storage/{{nova_get_setting('logo')}}" alt="" class="w-[50px]">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" x-show="! openMenu"  @click="openMenu = true" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none"  x-show="openMenu"  @click="openMenu = false"viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
        </svg>
    </div>
    <div x-show="openMenu">
        <a class="block text-center text-xl p-4 text-gray-900" href="/">Home</a>
        <a class="block text-center text-xl p-4 text-gray-900" href="/login">Login/Register</a>
    </div>
  </div>
  <div style="background:url('/pexels-fr3nks-305568.jpg')" class="text-center md:text-left w-full h-[60vh] bg-bottom bg-contain bg-cover bg-no-repeat">
        <div class="h-full w-full flex items-center justify-center md:justify-start font-serif px-4 md:w-3/4 mx-auto">
            <div class="space-y-4">
                <h1 class="text-3xl md:text-6xl"><span class="block text-[#0b6477] font-bold text-4xl md:text-6xl">{{nova_get_setting('name', 'JOYCE DENTAL SPA CLINIC')}}</span></h1>
                <div class="font-sans md:text-xl">Your Smile Says It All</div>
                <a href="/login" class="bg-white inline-block p-2 text-3xl outline outline-gray-200 px-4">Book an Appointment</a>
            </div>
        </div>
    </div>
  <div>
    <div class="w-full md:w-3/4 mx-auto">
        <div class="space-y-4 px-4 mt-4" id="about">
            <h1 class="text-center font-serif text-2xl md:text-left">About us</h1>
            <div class="text-justify text-lg">
                {{nova_get_setting('about', '---')}}
            </div>
        </div>
        <div class="space-y-4 px-4 mt-4" id="services">
            <h1 class="text-center font-serif text-2xl md:text-left ">Our Services</h1>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-4">
                @foreach (\App\Models\Service::get() as $item)
                <div class="overflow-hidden rounded-md bg-white">
                    <img src="/storage/{{$item->image}}" class="w-full object-cover h-[200px]" alt="">
                    <div class="p-4 space-y-4">
                        <h1 class="font-bold text-lg text-gray-800">{{$item->name}}</h1>
                        <p class="text-gray-700">{{\Str::limit($item->description, 100)}}</p>
                        <div class="text-right">
                            <a href="/reserve/{{$item->id}}" class="bg-[#0b6477] p-2 px-4 rounded-full inline-block text-white">Set Appointment</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
  </div>

<x-bot />
</body>
</html>
