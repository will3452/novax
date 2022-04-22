<!DOCTYPE html>
<html lang="en" data-theme="cmyk">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{config('app.name', 'Nuwang')}}</title>
    <link rel="stylesheet" href="/css/app.css">
    <script src="/js/app.js" defer></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    @stack('styles')
</head>
<body>
    {{-- <x-navbar></x-navbar> --}}
    <div id="app" class="md:w-11/12 p-2 mx-auto">
        @if (session()->has('success'))
            <x-alert-success>
                {{session()->get('success')}}
            </x-alert-success>
        @endif
        @if (session()->has('alert'))
            <x-alert-info>
                {{session()->get('alert')}}
            </x-alert-info>
        @endif
        @foreach ($errors->all() as $e)
            <x-alert-info>
                {{$e}}
            </x-alert-info>
        @endforeach
        {{$slot}}
    </div>
    @stack('scripts')
</body>
</html>
