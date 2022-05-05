<div class="navbar bg-base-300 rounded-box">
    <div class="flex-1 px-2 lg:flex-none">
      <a class="text-lg font-bold">{{config('app.name')}}</a>
    </div>
    <div class="flex justify-end flex-1 px-2">
      <div class="flex items-stretch">
        <a class="btn btn-ghost rounded-btn" href="{{route('login')}}">Login</a>
        <div class="dropdown dropdown-end">
          <label tabindex="0" class="btn btn-ghost rounded-btn">Register</label>
          <ul tabindex="0" class="menu dropdown-content p-2 shadow bg-base-100 rounded-box w-52 mt-4">
            <li><a href="/register">As Job Seeker</a></li>
            <li><a href="/register-employer">As Employer</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
