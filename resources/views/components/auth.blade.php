<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{url()->current()}}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <style>
        .bg-white {
            background: #fff !important;
        }

        .bordered{
            border: 1px solid #ddd;
        }
        .img {
            width: 100px !important;
        }
    </style>
</head>
<body style="background:#efefef">
    <div>
        @include('sweetalert::alert')
        <x-navbar></x-navbar>
        <div class="container mt-2">
            <div class="d-flex justify-content-between align-items-center">
                <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/home"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="m12.707 2.293l9 9c.63.63.184 1.707-.707 1.707h-1v6a3 3 0 0 1-3 3h-1v-7a3 3 0 0 0-2.824-2.995L13 12h-2a3 3 0 0 0-3 3v7H7a3 3 0 0 1-3-3v-6H3c-.89 0-1.337-1.077-.707-1.707l9-9a1 1 0 0 1 1.414 0M13 14a1 1 0 0 1 1 1v7h-4v-7a1 1 0 0 1 .883-.993L11 14z"/></svg></a></li>
                        @php
                            $url = [];
                        @endphp
                        @foreach (request()->segments() as $item)
                        @php
                            if ($item == 'titles') {
                                array_push($url, 'sections');
                            } else {
                                array_push($url, $item);
                            }
                        @endphp
                            @if ($loop->last)
                            <li class="breadcrumb-item">{{$item}}</li>
                            @else
                                <li class="breadcrumb-item active"><a href="/{{implode('/', $url)}}">{{$item == 'titles' ? 'sections' : $item}}</a></li>
                            @endif
                        @endforeach
                    </ol>
                  </nav>
                  <a href="{{url()->previous()}}" class="btn btn-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="m9 14l-4-4l4-4"/><path d="M5 10h11a4 4 0 1 1 0 8h-1"/></g></svg>
                    Back</a>
            </div>
        </div>
        <x-alert></x-alert>
        <main class="py-2">
            {{$slot}}
        </main>
    </div>
</body>
</html>
