<div id="home" class="fixed w-screen navbar shadow-lg bg-neutral text-neutral-content rounded-box">
    <div class="flex-none px-2 mx-2">
      <span class="text-lg font-bold">
        <img class="w-10 h-10 object-cover" src="/storage/{{nova_get_setting('logo')}}" alt="system logo">
    </span>
    </div>
    <div class="flex-1 px-2 mx-2">
      <div class="items-stretch hidden lg:flex">
          <x-navbar-link href="#">
              Home
          </x-navbar-link>
          <x-navbar-link href="#features">
            Features
          </x-navbar-link>
          <x-navbar-link href="#contacts">
            Contacts
          </x-navbar-link>
      </div>
    </div>
    <div>
      <x-navbar-link href="/register">
          Register
      </x-navbar-link>
    </div>
    <div >
        <x-navbar-link href="/admin/login">
            Login
        </x-navbar-link>
    </div>
  </div>
