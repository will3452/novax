<div class="rounded-lg shadow  drawer h-screen">
    <input id="my-drawer" type="checkbox" class="drawer-toggle">
    <div class="p-2 drawer-content">
        {{$slot}}
        <x-menu></x-menu>
    </div>
    <div class="drawer-side">
        <label for="my-drawer" class="drawer-overlay"></label>
        <ul class="menu p-4 overflow-y-auto w-80 bg-base-100 text-base-content">
            <li>
                <a href="/dashboard">Dashboard</a>
            </li>
            <li>
                <a href="/jobs">Browse Jobs</a>
            </li>
            <li>
                <a href="/logout" >Logout</a>
            </li>
        </ul>
    </div>
</div>
