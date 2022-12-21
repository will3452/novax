<div class=" bg-base-100 text-center text-2xl font-bold my-4">
    Memory Enhancer with Health Monitoring
</div>
<ul class=" bg-base-100 items-center flex justify-center">
    @if (! Auth::check())
            <li><a class="btn btn-sm mx-2 btn-link" href="/register">Register</a></li>
            <li><a class="btn btn-sm mx-2 btn-link" href="/login">Login</a></li>
        @else
            <li><a class="btn btn-sm mx-2 btn-link" href="/home">Home</a></li>
            <li><a class="btn btn-sm mx-2 btn-link" href="/games">Games</a></li>
            <li><a class="btn btn-sm mx-2 btn-link" href="/profile">Profile</a></li>
            <li><a class="btn btn-sm mx-2 btn-link" href="/logout">Logout</a></li>
        @endif
  </ul>
