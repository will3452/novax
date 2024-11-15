<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="icon" type="image/svg+xml" href="/storage/{{ nova_get_setting('logo') }}" />
    <script src="https://cdn.jsdelivr.net/npm/vue@2.7.16"></script>
    <style>
        .fixed-position {
            position: fixed;
            right: 0.25rem;
            /* equivalent to right-1 */
            bottom: 1.25rem;
            /* equivalent to bottom-5 */
            z-index: 9999;
        }

        @media (min-width: 768px) {

            /* for medium screens and up */
            .fixed-position {
                right: 1.25rem;
                /* equivalent to right-5 */
            }
        }

        .bouncing-pointer {
            cursor: pointer;
            width: 75px;
            animation: bounce 1s infinite;
            /* Animation effect for bounce */
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-25%);
            }
        }

        .custom-box {
            background-color: #f3f4f6;
            /* bg-gray-100 */
            border: 1px solid #e5e7eb;
            /* typical border color for gray borders */
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1), 0 1px 2px rgba(0, 0, 0, 0.06);
            /* shadow */
            width: 100%;
            max-width: 100%;
            height: 80vh;
            position: fixed;
            bottom: 0;
            right: 0;
            padding: 1rem;
            /* p-4 */
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            /* space-y-4 */
        }

        @media (min-width: 768px) {

            /* Medium screens and up */
            .custom-box {
                width: 450px;
                /* md:w-[450px] */
                height: 50vh;
                /* md:h-[50vh] */
            }
        }
        .green-button {
            margin-bottom: 0.5rem; /* mb-2 */
            background-color: #16a34a; /* bg-green-600 */
            color: #ffffff; /* text-white */
            padding: 0.5rem; /* p-2 */
            }
            .blue-button {
            margin-bottom: 0.5rem; /* mb-2 */
            background-color: #1e3a8a; /* bg-blue-900 */
            color: #ffffff; /* text-white */
            padding: 0.5rem; /* p-2 */
            }

            .green-border-box {
            color: #16a34a; /* text-green-600 */
            border: 1px solid #16a34a; /* border and border-green-600 */
            padding: 0.5rem; /* p-2 */
            display: flex; /* flex */
            align-items: center; /* items-center */
            }

            .green-text-box {
            width: 20px; /* w-[20px] */
            color: #16a34a; /* text-green-600 */
            }
            .flex-wrap-container {
            display: flex; /* flex */
            flex-wrap: wrap; /* flex-wrap */
            gap: 0.5rem; /* gap-2 */
            }

    </style>
</head>

<body>

    @include('sweetalert::alert')
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
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
                                <a class="nav-link" href="/">{{ __('Home') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/notifications">{{ __('Notifications') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" target="_blank" href="/dental-record/{{auth()->id()}}">{{ __('Dental Record') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/home">{{ __('Appointment') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/faq">{{ __('FAQ') }}</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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

        <!-- 2. Link VCalendar Javascript (Plugin automatically installed) -->
        <script src='https://unpkg.com/v-calendar'></script>
        <main>
            @yield('content')
        </main>

    </div>
</body>

</html>
