<div class="rounded-lg shadow  overflow-auto drawer h-screen mb-20 md:mb-0">
    <input id="my-drawer" type="checkbox" class="drawer-toggle">
    <div class="p-2 drawer-content">
        <send-email-verification isverify="{{auth()->user()->email_verified_at}}"></send-email-verification>
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
                @if (auth()->user()->canApplyJob())
                    <a href="/jobs">Browse Jobs</a>
                @else
                <a href="#">
                    <label for="no-resume">
                        Browse Jobs
                    </label>
                    <span class="material-icons">
                        lock
                    </span>
                </a>
                @endif
            </li>
            <li>
                <a href="/profile/{{auth()->id()}}" >Profile</a>
            </li>
            <li>
                <a href="/logout" >Logout</a>
            </li>
        </ul>
    </div>
</div>
