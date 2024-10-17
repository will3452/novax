<dropdown-trigger class="h-9 flex items-center">
    @isset($user->email)
        <img
            src="https://secure.gravatar.com/avatar/{{ md5(\Illuminate\Support\Str::lower($user->email)) }}?size=512"
            class="rounded-full w-8 h-8 mr-3"
        />
    @endisset

    <span class="text-90">
        {{ $user->name ?? $user->email ?? __('Nova User') }}
    </span>
</dropdown-trigger>

<dropdown-menu slot="menu" width="200" direction="rtl">
    <ul class="list-reset">
        <li>
            <a href="/admin-notifications" class="block no-underline text-90 hover:bg-30 p-3">
                @if(auth()->user()->unreadNotifications()->count())
                <span class="inline-block w-[25px] h-[25px] rounded-md bg-red-900 text-white text-center text-xs pt-1">{{auth()->user()->unreadNotifications()->count()}}</span>
                @endif
               Notifications
            </a>
        </li>
        <li>
            <a href="{{ route('nova.logout') }}" class="block no-underline text-90 hover:bg-30 p-3">
                {{ __('Logout') }}
            </a>
        </li>
    </ul>
</dropdown-menu>
