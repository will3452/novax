<nav class=" p-2 bg-blue-500">
    <div class="flex justify-between items-center md:w-2/3 mx-auto">
        <a href="/">
            <img class="rounded-full w-20" src="{{nova_get_setting('logo') ? "/storage/".nova_get_setting('logo') : 'https://via.placeholder.com/100x100?text=LOGO'}}" alt="">
        </a>
        <div>
            @auth
            <a href="/bookings" title="booking list">
                <span class="material-icons text-white" style="font-size:32px;">
                    view_list
                </span>
            </a>
            <a href="/profile">
                <span class="material-icons text-white" style="font-size:32px;">
                    account_circle
                </span>
            </a>
            <a href="/logout">
                <span class="material-icons text-white" style="font-size:32px;">
                    exit_to_app
                </span>
            </a>
            @else
            <a href="/register" class="uppercase font-bold text-white">
                Register
            </a>
            <span class="text-white">|</span>
            <a href="/login" class="uppercase font-bold text-white">
                Login
            </a>

            @endauth
        </div>
    </div>
</nav>
