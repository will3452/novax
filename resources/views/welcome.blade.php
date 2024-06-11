<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CT Journey</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white md:bg-gray-200">
    <div class="h-screen grid items-center grid-cols-1 md:grid-cols-2 justify-center gap-4 md:gap-4  w-screen">
        <div class="bg-white w-full p-4 md:p-8 md:h-full  md:rounded-none flex items-center justify-center">
            <form action="{{route('nova.login')}}" method="POST" class="space-y-4">
                @csrf 
                <img src="/storage/{{nova_get_setting('logo')}}" class="block md:hidden w-[20%] mx-auto" alt="logo here"/>
                <h1 class="text-xl md:text-[54px] font-bold text-gray-800 text-center md:text-left">Welcome back!</h1>
                <h2 class="text-base md:text-xl text-center md:text-left">
                    Please enter your credentials to access your account & enjoy exclusive features.
                </h2>
                <div class="space-y-2">
                    <label for="" class="font-bold text-black block">Email Address</label>
                    <input name="email" required type="text" class="border w-full border-2 p-4 ">
                </div>
                <div class="space-y-2">
                    <label for="" class="font-bold text-black block">Password</label>
                    <input name="password" required type="password" class="border w-full border-2 p-4 ">
                </div>
                <button class="hover:bg-blue-900 hover:text-white transition w-full bg-blue-200 p-4  font-bold text-gray-900">
                    LOGIN
                </button>
            </form>
        </div>
        <div class="hidden md:block text-center space-y-3">
            <h1 class="text-[40px] font-bold text-gray-900">Capstone & Thesis</h1>
            <h2 class="text-[32px] font-thin">Workflow Management System</h2>
            <img src="/storage/{{nova_get_setting('logo')}}" class="animate-pulse w-[20%] md:w-1/3 mx-auto" alt="logo here"/>
        </div>
    </div>
</body>
</html>