
    <!-- Navbar Start -->
    <div class="container-fluid nav-bar p-0">
        <div class="container-lg p-0">
            <nav class="navbar navbar-expand-lg bg-secondary navbar-dark">
                <a href="/" class="navbar-brand">
                    <h1 class="m-0 text-white display-4"><span class="text-primary">Y</span>our<span class="text-primary">W</span>ebsite</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav ml-auto py-0">
                        <x-nav-link :link="route('landing')">Home</x-nav-link>
                        <x-nav-link :link="route('about')">About</x-nav-link>
                        <x-nav-link :link="'/'">Announcements</x-nav-link>
                        <x-nav-link :link="'/'">Events</x-nav-link>
                        <x-nav-link :link="route('contact')">Contacts</x-nav-link>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Downloads</a>
                            <div class="dropdown-menu border-0 rounded-0 m-0">
                                <a href="#form1" class="dropdown-item">Form 1</a>
                                <a href="#form2" class="dropdown-item">Form 2</a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->
