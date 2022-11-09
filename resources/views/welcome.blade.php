<x-layout>
    <div class="navbar">
        <div class="flex-1">
          <a class="btn btn-ghost normal-case text-xl">
            {{ nova_get_setting('app_name', 'generic health unit') }}
          </a>
        </div>
        <div class="flex-none">
          <ul class="menu menu-horizontal p-0">
            <li><a href="/app/login" class=" btn-secondary btn-sm mx-2 uppercase">Login</a></li>
            <li><a href="/register" class=" btn-secondary btn-sm mx-2 uppercase">Register</a></li>
          </ul>
        </div>
      </div>

      <div class="flex   items-center justify-center flex-col " style='height:400px;'>
        <h1 class="text-3xl font-bold backdrop-filter backdrop-blur-lg">{{nova_get_setting('app_name', 'RHU')}}</h1>
        <h1 class="text-2xl backdrop-filter backdrop-blur-lg">{{nova_get_setting('introduction', 'generic health unit')}}</h1>
        <a class="btn btn-primary mt-4 z-9999" href="{{nova_get_setting('yt_link', '#')}}" target="_blank">Watch The intro</a>
      </div>
</x-layout>
