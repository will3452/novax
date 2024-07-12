<dropdown-trigger class="h-9 flex items-center">

    <span class="text-90" style="{{(auth()->user()->isAdmin() ? 'background: #fff; color: #000;':( auth()->user()->isFaculty() ? 'background: #152C58; color: #fff;' : (auth()->user()->isStudent() ? 'background: #C71223; color: #fff': 'background: #E6E6E7 !important; color: #000')))}}">
        {{ $user->name ?? $user->email ?? __('Nova User') }}
    </span>
</dropdown-trigger>

<dropdown-menu slot="menu" width="200" direction="rtl">
    <ul class="list-reset">
        <li>
            <a href="/app/resources/users/{{auth()->id()}}" class="block no-underline text-90 hover:bg-30 p-3">
                {{ __('Profile') }}
            </a>
        </li>
        <li>
            <a href="{{ route('nova.logout') }}" class="block no-underline text-90 hover:bg-30 p-3">
                {{ __('Logout') }}
            </a>
        </li>
    </ul>
</dropdown-menu>
