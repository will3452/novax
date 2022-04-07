<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{!!nova_get_setting('system_name','CHANGE MY NAME')!!}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2/dist/tailwind.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <header style="background: #6A7BCF;" class="text-white text-center text-3xl font-bold p-4">
        {!!nova_get_setting('system_name','CHANGE MY NAME')!!}
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
                Email: {{nova_get_setting('email', 'admin@admin.com')}}
            </div>
            <div>
                Phone: {{nova_get_setting('phone', '09121808887')}}
            </div>
        </div>
        <div id="map" class="mt-10 mb-20 mx-auto w-6/12">
            {!!nova_get_setting('map_code','map here')!!}
        </div>
    </div>
    <footer class="mb-20 text-2xl text-center text-gray-600">
        COPYRIGHT - {{now()->format('Y')}} , {!!nova_get_setting('system_name','CHANGE MY NAME')!!}
    </footer>
</body>
</html>
