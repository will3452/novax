
<nav
    @guest
        class="navbar navbar-expand-md navbar-dark shadow-sm bg-primary"
    @endguest
@auth
    @student
    class="navbar navbar-expand-md navbar-dark shadow-sm"
    style="background:rgb(21, 44, 88) !important; "
    @else
        @admin
            class="navbar navbar-expand-md navbar-light shadow-sm"
            style="background: #fff !important; border-color: #ccc;"
        @else
            class="navbar navbar-expand-md navbar-dark shadow-sm"
            style="background:#c71223 !important; border-color:#a0101e;"
        @endadmin
    @endstudent
@endauth
>
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
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5m-4-9v4M8 3v4m-4 4h16m-2.999 8a2 2 0 1 0 4 0a2 2 0 1 0-4 0m2-3.5V17m0 4v1.5m3.031-5.25l-1.299.75m-3.463 2l-1.3.75m0-3.5l1.3.75m3.463 2l1.3.75"/></svg>
                        {{nova_get_setting('term')}}, {{nova_get_setting('school_year')}}
                    </a>
                </li>
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
                        <a class="nav-link flex gap-2" href="/home">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4h4a1 1 0 0 1 1 1v6a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1m0 12h4a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-2a1 1 0 0 1 1-1m10-4h4a1 1 0 0 1 1 1v6a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1v-6a1 1 0 0 1 1-1m0-8h4a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1"/></svg>
                            {{ __('Home') }}
                        </a>
                    </li>
                    @ca
                        <li class="nav-item">
                            <a class="nav-link flex gap-2" href="{{route('news.index')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" color="currentColor"><path d="M10.5 8h8m-8 4H13m5.5 0H16m-5.5 4H13m5.5 0H16M7 7.5H6c-1.886 0-2.828 0-3.414.586S2 9.614 2 11.5V18a2.5 2.5 0 0 0 5 0z"/><path d="M16 3.5h-5c-.93 0-1.395 0-1.776.102a3 3 0 0 0-2.122 2.122C7 6.105 7 6.57 7 7.5V18a2.5 2.5 0 0 1-2.5 2.5H16c2.828 0 4.243 0 5.121-.879C22 18.743 22 17.328 22 14.5v-5c0-2.828 0-4.243-.879-5.121C20.243 3.5 18.828 3.5 16 3.5"/></g></svg>
                                {{__('Announcements')}}
                            </a>
                        </li>
                    @endca
                    @admin
                    <div class="nav-item">
                        <a href="{{route('settings')}}" class="nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="M18.525 8.3q-.125 0-.262-.075T18.075 8l-.65-1.4l-1.4-.65q-.15-.05-.225-.187t-.075-.263q0-.125.075-.262t.225-.188l1.4-.65l.65-1.4q.05-.15.188-.225t.262-.075q.125 0 .263.075t.187.225l.65 1.4l1.4.65q.15.05.225.188t.075.262q0 .125-.075.263t-.225.187l-1.4.65l-.65 1.4q-.05.15-.188.225t-.262.075Zm2 7.025q-.125 0-.25-.075t-.2-.2l-.35-.75l-.75-.35q-.075-.05-.275-.45q0-.125.075-.25t.2-.2l.75-.35l.35-.75q.05-.075.45-.275q.125 0 .25.075t.2.2l.35.75l.75.35q.075.05.275.45q0 .125-.075.25t-.2.2l-.75.35l-.35.75q-.05.075-.45.275ZM8.4 22q-.375 0-.65-.25t-.325-.625l-.2-1.475q-.2-.075-.388-.2t-.312-.25l-1.375.6q-.35.15-.713.038t-.562-.463l-1.6-2.8q-.2-.35-.125-.713t.4-.587l1.175-.875v-.8l-1.175-.875q-.325-.225-.4-.588t.125-.712l1.6-2.8q.2-.35.563-.463t.712.038l1.375.6q.125-.125.313-.25t.387-.2l.2-1.475q.05-.375.325-.625T8.4 6h3.25q.375 0 .65.25t.325.625l.2 1.475q.2.075.388.2t.312.25l1.375-.6q.35-.15.712-.037t.563.462l1.6 2.8q.2.35.125.713t-.4.587l-1.175.875v.8l1.175.875q.325.225.4.588t-.125.712l-1.6 2.8q-.2.35-.563.463T14.9 19.8l-1.375-.6q-.125.125-.313.25t-.387.2l-.2 1.475q-.05.375-.325.625t-.65.25H8.4Zm1.625-5q1.25 0 2.125-.875T13.025 14q0-1.25-.875-2.125T10.025 11q-1.25 0-2.125.875T7.025 14q0 1.25.875 2.125t2.125.875Zm0-3Z"/></svg>
                            Settings
                        </a>
                    </div>
                    @endadmin
                    <li class="nav-item">
                        <a class="nav-link flex gap-2" href="{{route('tasks.index')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 9h6M4 5h4M6 5v11a1 1 0 0 0 1 1h5m0-9a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-6a1 1 0 0 1-1-1zm0 8a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-6a1 1 0 0 1-1-1z"/></svg>
                            {{ __('Tasks') }}
                            @if (\App\Models\Task::whereStatus('PENDING')->whereUserId(auth()->id())->count())
                                <span class="badge bg-danger">
                                    {{\App\Models\Task::whereStatus('PENDING')->whereUserId(auth()->id())->count()}}
                                </span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link flex gap-2" href="{{route('notifications.index')}}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="M17.451 2.344a1 1 0 0 1 1.41-.099a12.05 12.05 0 0 1 3.048 4.064a1 1 0 1 1-1.818.836a10.05 10.05 0 0 0-2.54-3.39a1 1 0 0 1-.1-1.41zM5.136 2.245a1 1 0 0 1 1.312 1.51a10.05 10.05 0 0 0-2.54 3.39a1 1 0 1 1-1.817-.835a12.05 12.05 0 0 1 3.045-4.065M14.235 19c.865 0 1.322 1.024.745 1.668A4 4 0 0 1 12 22a4 4 0 0 1-2.98-1.332c-.552-.616-.158-1.579.634-1.661l.11-.006zM12 2c1.358 0 2.506.903 2.875 2.141l.046.171l.008.043a8.01 8.01 0 0 1 4.024 6.069l.028.287L19 11v2.931l.021.136a3 3 0 0 0 1.143 1.847l.167.117l.162.099c.86.487.56 1.766-.377 1.864L20 18H4c-1.028 0-1.387-1.364-.493-1.87a3 3 0 0 0 1.472-2.063L5 13.924l.001-2.97A8 8 0 0 1 8.822 4.5l.248-.146l.01-.043a3 3 0 0 1 2.562-2.29l.182-.017z"/></svg>
                            {{ __('Notifications') }}
                            @if (auth()->user()->unreadNotifications()->count())
                            <span class="badge bg-danger">
                                {{auth()->user()->unreadNotifications()->count()}}
                            </span>
                            @endif
                        </a>
                    </li>
                    @nonstudent
                        <li class="nav-item">
                            <a class="nav-link  gap-2" href="/calendars">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="M11 14v-2h2v2zm-4 0v-2h2v2zm8 0v-2h2v2zm-4 4v-2h2v2zm-4 0v-2h2v2zm8 0v-2h2v2zM3 22V4h3V2h2v2h8V2h2v2h3v18zm2-2h14V10H5z"/></svg>
                                {{ __('Calendar') }}
                            </a>
                        </li>
                    @endnonstudent
                    <li class="nav-item">
                        <a class="nav-link gap-2" href="/sections">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0-4 0m-2 8v-1a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v1M15 5a2 2 0 1 0 4 0a2 2 0 0 0-4 0m2 5h2a2 2 0 0 1 2 2v1M5 5a2 2 0 1 0 4 0a2 2 0 0 0-4 0m-2 8v-1a2 2 0 0 1 2-2h2"/></svg>
                            {{ __('Sections') }}</a>
                    </li>
                    @admin
                    <li class="nav-item">
                        <a href="/admin" class="nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="M17 11c.34 0 .67.04 1 .09V6.27L10.5 3L3 6.27v4.91c0 4.54 3.2 8.79 7.5 9.82c.55-.13 1.08-.32 1.6-.55c-.69-.98-1.1-2.17-1.1-3.45c0-3.31 2.69-6 6-6"/><path fill="currentColor" d="M17 13c-2.21 0-4 1.79-4 4s1.79 4 4 4s4-1.79 4-4s-1.79-4-4-4m0 1.38c.62 0 1.12.51 1.12 1.12s-.51 1.12-1.12 1.12s-1.12-.51-1.12-1.12s.5-1.12 1.12-1.12m0 5.37c-.93 0-1.74-.46-2.24-1.17c.05-.72 1.51-1.08 2.24-1.08s2.19.36 2.24 1.08c-.5.71-1.31 1.17-2.24 1.17"/></svg>
                            Administration
                        </a>
                    </li>
                    @endadmin
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
