<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{env('APP_NAME')}}</title>
    <link rel="stylesheet" href="/css/app.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body>
    @include('sweetalert::alert')
    <div class="text-center mt-2 uppercase font-bold">
        <a href="/">
            <img class="w-32 mx-auto" src="/storage/{{nova_get_setting('logo')}}" alt="">
        </a>
    </div>
    {{$slot}}
</body>
</html>