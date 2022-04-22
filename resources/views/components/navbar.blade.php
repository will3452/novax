<div class="navbar bg-base-200 border-gray-200 mb-5">
<div class="flex-1">
    <a href="/" class="btn btn-ghost normal-case text-xl">Online Examination System in Joyland</a>
</div>
<div class="flex-none">
    <ul class="menu menu-horizontal p-0">
        @guest
        <li><a href="/about">About</a></li>
        <li><a href="/login">Login</a></li>
        @endguest

        @auth
        <li><a href="/home">Dashboard</a></li>
        <li><a href="/exams">Examinations</a></li>
        <li><a href="/account">Account</a></li>
        <li><a href="/logout">Logout</a></li>
        @endauth
    </ul>
</div>
</div>
