<x-layout>
    <div class="navbar bg-base-100">
        <div class="flex-1">
          <a class="btn btn-ghost normal-case text-xl">
            {{ nova_get_setting('app_name', 'RHU') }}
          </a>
        </div>
        <div class="flex-none">
          <ul class="menu menu-horizontal p-0">
            <li><a href="/app/login">Login</a></li>
            <li><a href="/register">Register</a></li>
          </ul>
        </div>
      </div>

      <div class="flex  items-center justify-center flex-col" style='height:400px;'>
        <h1 class="text-3xl font-bold">{{nova_get_setting('app_name', 'RHU')}}</h1>
        <h1 class="text-2xl">{{nova_get_setting('introduction', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Magnam, ipsam?')}}</h1>
        <a class="btn btn-primary mt-4">Watch The intro</a>
      </div>
</x-layout>
