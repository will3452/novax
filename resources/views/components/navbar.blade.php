<div class="navbar mb-2 shadow-lg bg-neutral text-neutral-content">
    @auth
    <div class="flex-none hidden lg:flex">
        <label href="#" class="btn btn-square btn-ghost drawer-button" for="my-drawer">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-6 h-6 stroke-current">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
              </svg>
          </label>
      </div>
    @endauth
    <div class="flex-1 hidden px-2 mx-2 lg:flex">
      <span class="text-lg font-bold">
        {{config('app.name')}}
    </span>
    </div>
    @auth
    <search-engine></search-engine>
    <div class="flex-none">
      <a class="btn btn-square btn-ghost animate-pulse" href="/notifications">
       @if (auth()->user()->unreadNotifications()->count())
       <div class="badge badge-xs">
        </div>
       @endif
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-6 h-6 stroke-current">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
        </svg>
    </a>
    </div>
    <div class="flex-none">
        <message-icon user="{{auth()->user()}}"></message-icon>
    </div>
    <div class="flex-none">
      <a href="/profile/{{auth()->id()}}">
        <div class="avatar">
            <div class="rounded-full w-10 h-10 m-1 cursor-pointer">
              <img src="{{auth()->user()->profile ? auth()->user()->profile->public_picture: '/user.png'}}">
            </div>
        </div>
      </a>
    </div>
    @endauth
  </div>
