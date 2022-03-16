<div class="navbar bg-base-100">
    <div class="flex-1">
      <a href="/" class="btn btn-ghost normal-case text-xl">{{config('app.name', 'My-App')}}</a>
    </div>
    <div class="flex-none">
      <ul class="menu menu-horizontal p-0">
        @if (! Auth::check())
            <li><a href="/register">Register</a></li>
            <li><a href="/login">Login</a></li>
        @else
            <li><a href="/applications">Apps</a></li>
            <li><a href="/games">Games</a></li>
            <li><a href="/profile">Profile</a></li>
            <li><a href="/logout">Logout</a></li>
        @endif
      </ul>
    </div>
  </div>
