<!DOCTYPE html>
<html lang="en" data-theme="wireframe">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{config('app.name', 'Nuwang')}}</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.6.0/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
        *  {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
        }
    </style>
</head>
<body >
    <x-navbar></x-navbar>
    @if (session('alert'))
        <x-alert-warning>
            {{session('alert')}}
        </x-alert-warning>
    @endif
    @if (session('success'))
        <x-alert-success>
            {{session('success')}}
        </x-alert-success>
    @endif
    @if ($errors->any())
        @foreach ($errors->all() as $item)
            <x-alert-warning>
                {{$item}}
            </x-alert-warning>
        @endforeach
    @endif
    {{$slot}}
</body>
</html>
