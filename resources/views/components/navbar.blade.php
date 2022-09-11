<div class="navbar bg-primary">
    <div class="flex-1">
      <a href="/" class="btn btn-ghost normal-case text-xl">{{config('app.name')}}</a>
    </div>
    <div class="flex-1">
        <div class="uppercase text-center text-xs font-serif flex">
            <span class="flex">
                <svg class="mx-2" width="16" height="16" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 0 1 2-2h3.28a1 1 0 0 1 .948.684l1.498 4.493a1 1 0 0 1-.502 1.21l-2.257 1.13a11.042 11.042 0 0 0 5.516 5.516l1.13-2.257a1 1 0 0 1 1.21-.502l4.493 1.498a1 1 0 0 1 .684.949V19a2 2 0 0 1-2 2h-1C9.716 21 3 14.284 3 6V5Z"/></svg>
                09121808887
            </span>
             <span class="flex">
                <svg class="mx-2" width="16" height="16" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m3 8l7.89 5.26a2 2 0 0 0 2.22 0L21 8M5 19h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2Z"/></svg>
                store@gmail.com
             </span>
        </div>
    </div>
    <div class="flex-none">
        <form class="flex items-center">
            <input type="text" placeholder="Search" name="search" value="{{request()->search}}" class="p-1 px-2 rounded"> <button class="mx-2 btn-sm btn btn-warning rounded" type="submit">Find</button>
            @if (request()->has('category'))
                <input type="hidden" name="category" value="{{request()->category}}">
            @endif
        </form>
      <div class=" mx-2 ">
        <a href="/orders" class="btn btn-ghost btn-circle">
            <svg class="h-5 w-5" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2M9 5a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2M9 5a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2m-6 9l2 2l4-4"/></svg>
        </a>
      </div>
      <div class="dropdown dropdown-end mx-2 ">
        <label tabindex="0" class="btn btn-ghost btn-circle">
          <div class="indicator">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
            @if (auth()->check() && auth()->user()->cartItems()->count())
                <span class="badge badge-sm indicator-item">{{auth()->user()->cartItems()->count()}}</span>
            @endif
          </div>
        </label>
        @auth
        <div tabindex="0" class="mt-3 card card-compact dropdown-content w-52 bg-base-100 shadow">
            <div class="card-body">
              <span class="font-bold text-lg">{{auth()->user()->cartItems()->count()}} Item{{auth()->user()->cartItems()->count() != 1 ? 's':''}} </span>
              <span class="text-accent">Subtotal: ₱ {{number_format(auth()->user()->subTotal(), 2)}}</span>
              <div class="card-actions">
                <a href="/carts" class="btn btn-primary btn-block">View cart</a>
              </div>
            </div>
          </div>
        @endauth
      </div>
      <div class="dropdown dropdown-end mx-2">
        <label tabindex="0" class="btn btn-ghost btn-circle avatar">
          <div class="w-10 rounded-full">
            <img src="/empty_user.jpg" />
          </div>
        </label>
        <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
          @auth
            <li>
                <a href="/app" class="justify-between">
                Dashboard
                </a>
            </li>
            <li><a href="/logout" >Logout</a></li>
         @else
         <li>
            <a href="/app/login">Login</a>
         </li>
         <li>
            <a href="/register">Register</a>
         </li>
          @endauth
        </ul>
      </div>
    </div>
  </div>
