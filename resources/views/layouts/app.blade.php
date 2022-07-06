<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <style>
        .dashboard-icon {
            width:50px !important;
        }
        .dashboard-card {
            display: flex !important;
            justify-content: center !important;
            align-items: center;
            flex-direction: column;
            background: white;
            border: 1px solid #ddd;
            padding: 1em;
            border-radius: 10px;
            cursor: pointer;
        }
        .dashboard-card:hover {
            background: #eee;
        }
        .dashboard-link {
            text-decoration: none;
            color: #222;
            transition: all 50ms;
        }
        .dashboard-link:hover {
            transform: scale(1.1);
            color:#222;
        }
    </style>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://unpkg.com/alpinejs" defer></script>
</head>
<body>
    @include('sweetalert::alert')
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm" style="background: #d3e8ff">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="/img/logo.png" alt="" style="width:100px">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a href="/home" class="nav-link">Dashboard</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>


                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @if (session()->get('success'))
                <div class=" mx-2 alert alert-success">
                    {{session()->get('success')}}
                </div>
            @endif
            @yield('content')

      <footer class="bg-primary text-white p-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5 class="mb-4">Contact</h5>
                    <p>info@nutriserve.site</p>
                    <p>09952250571</p>
                </div>
                <div class="col-md-4 d-flex justify-content-center">
                    <img src="/img/Nutri-1-150x150.png" alt="">
                </div>
                <div class="col-md-4 text-right">
                    <h5 class="mb-4">Address</h5>
                    <p>Tarlac State University</p>
                    <p>Romulo Blvd Tarlac City, Tarlac</p>
                </div>
            </div>
            <div class="text-sm text-center">
                <small>Copyright © 2022 NutriServe</small>
            </div>
        </div>
      </footer>
        </main>
    </div>


    <script>
        $(function(){
            $('#table').DataTable();
        })
    </script>
</body>
</html>
