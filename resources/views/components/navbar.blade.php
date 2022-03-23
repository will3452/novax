<div class="navbar bg-base-100 shadow overflow-x-auto">
    <div class="flex-1">
        @guest
            <a href="/" class="btn btn-ghost normal-case text-xl">{{config('app.name')}}</a>
        @else
            <a href="/home" class="btn btn-ghost normal-case text-xl">{{config('app.name')}}</a>
        @endguest
    </div>
    <div class="flex-none">
      <ul class="menu menu-horizontal p-0">
        @guest
            <li  class="hidden md:block"><a href="/about">About Us</a></li>
        @endguest
        @auth
        <li class="hidden md:inline-block"><a href="/home">Dashboard</a></li>
        <li><a href="/profile">My Profile</a></li>
            @teacher
                <li><a href="{{route('teacher.room')}}">My Room</a></li>
            @endteacher
            @student
                <li><a href="{{route('student.room')}}">My Room</a></li>
            @endstudent
            <li  class="hidden md:block"><a href="/contact">Contact Us</a></li>
            <li><a href="/logout">Logout</a></li>
        @endauth
      </ul>
    </div>
  </div>
