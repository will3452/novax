<div class="navbar bg-base-100 shadow-xl mb-5">
<div class="flex-1">
    <a href="/" class="btn btn-ghost normal-case text-xl">{{nova_get_setting('app_name', config('app.name'))}}</a>
</div>
<div class="flex-none">
    <ul class="menu menu-horizontal p-0">
        @guest
        <li><a href="/">Home</a></li>
        <li><a href="/about">About</a></li>
        <li><a href="/login">Login</a></li>
        @endguest

        @auth
        <li><a href="/home">Dashboard</a></li>
        <li><a href="/exams">Examinations</a></li>
        <li><a href="/logout">Logout</a></li>
        @endauth
    </ul>
</div>
</div>
