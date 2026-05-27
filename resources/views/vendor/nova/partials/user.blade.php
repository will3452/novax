<dropdown-trigger class="h-9 flex items-center">
    @isset($user->email)
        <img
            src="https://api.dicebear.com/9.x/micah/svg?seed={{$user->name}}"
            class="rounded-full w-8 h-8 mr-3"
        />
    @endisset

    <div class="text-left">
        <div class="text-90">
            {{ $user->name ?? $user->email ?? __('Nova User') }}
        </div>
        <div class="text-90 text-xs">
            {{$user->role}}
        </div>
    </div>
</dropdown-trigger>

<dropdown-menu slot="menu" width="200" direction="rtl">
    <ul class="list-reset">
        <li>
            <a href="{{ route('nova.logout') }}" class="block no-underline text-90 hover:bg-30 p-3">
                {{ __('Logout') }}
            </a>
        </li>
    </ul>
</dropdown-menu>
