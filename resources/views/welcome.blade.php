<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2/dist/tailwind.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <header style="background: #6A7BCF;" class="text-white text-center text-3xl font-bold p-4">
        {{config('app.name', 'hello world')}}
    </header>
    <div>
        <div class="flex justify-center -mt-20">
            <div class="w-5/12">
                <x-landing-image></x-landing-image>
            </div>
        </div>
        <div class="flex justify-center -mt-20">
            <a href="/admin/login" class="font-bold text-2xl mx-4 p-4 shadow rounded-2xl border-2 px-16 ">
                SIGN IN
            </a>
            <a href="/register" class="font-bold text-2xl mx-4 p-4 shadow rounded-2xl px-16 text-white"
            style="background: #6A7BCF;">
                SIGN UP
            </a>
        </div>
    </div>
    <div class="text-center">
        <h2 class="mt-20 font-bold text-4xl tracking-widest text-gray-700">
            CONTACT US
        </h2>
        <div class="mt-4">
            <div>
                Email: william@mail.com
            </div>
            <div>
                Phone: +63903 - 123 - 3344
            </div>
        </div>
        <div id="map" class="mt-10 mb-20 mx-auto w-6/12">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d15447.469809057398!2d121.04497624999998!3d14.54957145!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sph!4v1645522395342!5m2!1sen!2sph" class="w-full" style="height:400px;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>
    <footer class="mb-20 text-2xl text-center text-gray-600">
        COPYRIGHT - {{now()->format('Y')}} , {{config('app.name')}}
    </footer>
</body>
</html>
