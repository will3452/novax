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

    @if(config('app.env') == 'local')
        <script src="http://localhost:35729/livereload.js"></script>
    @endif
</head>
<body>
    <div id="app" style="background: url('/bg-client.jpg'); height:100vh; overflow-y: auto; background-size: cover;">
        <nav class="navbar navbar-expand-md navbar-dark bg-white shadow-sm" style="background: #1890FF !important;">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
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

                                <a href="/notifications" class="nav-link">
                                    Notifications
                                </a>
                            </li>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                    <a href="/home" class="dropdown-item">
                                        Dashboard
                                    </a>
                                    @if (auth()->user()->type === \App\Models\User::TYPE_CLIENT)
                                        <a href="/bookings" class="dropdown-item">
                                            Bookings
                                        </a>
                                        <a href="/tickets" class="dropdown-item">
                                            Tickets
                                        </a>
                                        <a href="/notices" class="dropdown-item">
                                            Notices
                                        </a>
                                        <a href="/profile" class="dropdown-item">
                                            Profile
                                        </a>
                                    @else
                                        <a href="/scan" class="dropdown-item">
                                            Scan
                                        </a>
                                        <a href="/notices" class="dropdown-item">
                                            Notices
                                        </a>
                                        <a href="/profile" class="dropdown-item">
                                            Profile
                                        </a>
                                    @endif
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
        <layout>
            @auth
                @if (auth()->user()->type === \App\Models\User::TYPE_CLIENT)
                <layout-menu :items="[
                    {label: 'Dashboard', icon: 'dashboard', 'link': '/home'},
                    {label: 'Booking', icon: 'pushpin', 'link': '/bookings'},
                    {label: 'Tickets', icon: 'profile', 'link': '/tickets'},
                    {label: 'Notices', icon: 'notification', 'link': '/notices'},
                    {label: 'Map', icon: 'compass', 'link': '/map'},
                   //  {label: 'History', icon: 'history', 'link': '#history'},
                    {label: 'Account', icon: 'user', link: '/profile'},
                    {label: 'Sign out', icon: 'logout', link: '/logout'}
                    ]"></layout-menu>
                @elseif(auth()->user()->type === \App\Models\User::TYPE_CONDUCTOR)
                <layout-menu :items="[
                    {label: 'Dashboard', icon: 'dashboard', 'link': '/home'},
                    // {label: 'Booking', icon: 'pushpin', 'link': '/bookings'},
                    // {label: 'Tickets', icon: 'profile', 'link': '/tickets'},
                    {label: 'Scan', icon: 'qrcode', link: '/scan'},
                    {label: 'Notices', icon: 'notification', 'link': '/notices'},
                    {label: 'Map', icon: 'compass', 'link': '/map'},
                   //  {label: 'History', icon: 'history', 'link': '#history'},
                    {label: 'Account', icon: 'user', link: '/profile'},
                    {label: 'Sign out', icon: 'logout', link: '/logout'}
                    ]"></layout-menu>
                @endif
            @endauth
             <layout-content>
                 @yield('content')
             </layout-content>
         </layout>
    </div>
</body>
</html>
