<div class="navbar bg-base-100 shadow">
    <div class="flex-1">
      <a href="/" class="btn btn-ghost normal-case text-xl">{{config('app.name')}}</a>
    </div>
    <div class="flex-none">
      <ul class="menu menu-horizontal p-0">
        @guest
            <li class="hidden md:block"><a href="/">Home</a></li>
            <li  class="hidden md:block"><a href="/about">About Us</a></li>
            <li><a href="/login">Login</a></li>
        @endguest
        @auth
        <li class="hidden md:inline-block"><a href="/home">Dashboard</a></li>
        <li  class="hidden md:block"><a href="/contact">Contact Us</a></li>
            @teacher
                <li><a href="{{route('teacher.room')}}">My Room</a></li>
            @endteacher

            @student
                <li><a href="{{route('student.room')}}">My Room</a></li>
            @endstudent
            <li><a href="/logout">Logout</a></li>
        @endauth
      </ul>
    </div>
  </div>
