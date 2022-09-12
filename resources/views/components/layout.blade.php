<!DOCTYPE html>
<html lang="en" data-theme="mytheme">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{config('app.name', 'Nuwang')}}</title>
    <link rel="stylesheet" href="/css/app.css">
    <script defer src="https://unpkg.com/alpinejs@3.10.3/dist/cdn.min.js"></script>
</head>
<body>
    @if (session()->has('error'))
        <div class="alert alert-warning rounded-none">
            {{session()->get('error')}}
        </div>
    @endif
    {{$slot}}
</body>
</html>
