<header class="header-area clearfix header-hm8">
    <div class="header-top-area header-padding-2">
        <div class="container-fluid">
            <div class="header-top-wap">
                <div class="language-currency-wrap">
                    <div class="same-language-currency use-style">
                        <p>Call Us {{nova_get_setting('phone', '09121808886')}}</p>
                    </div>
                    <div class="same-language-currency use-style">
                        <p>Email Us {{ nova_get_setting('email', 'email@gmail.com') }}</p>
                    </div>
                </div>
                <div class="header-right-wrap">
                    <div class="same-style header-search mx-2">
                        <a class="search-active" href="#"><i class="pe-7s-search"></i></a>
                        <div class="search-content">
                            <form action="/s">
                                <input type="text" name="name" placeholder="Search By Name" />
                                <button class="button-search"><i class="pe-7s-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class=" account-satting">
                        @guest
                            <a class="" href="/login">LOGIN</a>  |
                            <a class="" href="/register">REGISTER</a>
                        @else
                            <a class="" href="/home">DASHBOARD</a>  |
                            <a class="" href="/logout">LOGOUT</a>
                        @endguest
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom sticky-bar header-res-padding header-padding-2">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-6 col-4">
                    <div class="logo text-center">
                        <x-logo></x-logo>
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 d-none d-lg-block">
                    <x-menu></x-menu>
                </div>
            </div>
            <div class="mobile-menu-area">
                <x-mobile-menu></x-mobile-menu>
            </div>
        </div>
    </div>
</header>
