<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full font-sans antialiased">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=1280">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ \Laravel\Nova\Nova::name() }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,800,800i,900,900i" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('app.css', 'vendor/nova') }}">

    <!-- Tool Styles -->
    @foreach(\Laravel\Nova\Nova::availableStyles(request()) as $name => $path)
        @if (\Illuminate\Support\Str::startsWith($path, ['http://', 'https://']))
            <link rel="stylesheet" href="{!! $path !!}">
        @else
            <link rel="stylesheet" href="/nova-api/styles/{{ $name }}">
        @endif
    @endforeach

    <!-- Custom Meta Data -->
    @include('nova::partials.meta')

    <style>
        [dusk="create-and-add-another-button"] {
            display: none !important;
        }

    </style>

    <!-- Theme Styles -->
    @foreach(\Laravel\Nova\Nova::themeStyles() as $publicPath)
        <link rel="stylesheet" href="{{ $publicPath }}">
    @endforeach
</head>
<body class="min-w-site bg-40 text-90 font-medium min-h-full ">
    <div id="nova">
        <div v-cloak class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="md:hidden flex-none pt-header min-h-screen w-sidebar bg-grad-sidebar px-6">
            <a href="{{ \Laravel\Nova\Nova::path() }}">
                <div class="absolute pin-t pin-l pin-r bg-logo flex items-center w-sidebar h-header px-6 text-white">
                @include('nova::partials.logo')
                </div>
            </a>

            @foreach (\Laravel\Nova\Nova::availableTools(request()) as $tool)
                {!! $tool->renderNavigation() !!}
            @endforeach
        </div>
        <!--
        <div class="content md:hidden">
            <div class="flex items-center relative shadow h-header bg-white z-20 px-view">
                <div class="md:hidden block">
                    <a v-if="@json(\Laravel\Nova\Nova::name() !== null)" href="{{ \Illuminate\Support\Facades\Config::get('nova.url') }}" class="no-underline dim font-bold text-90 mr-6">
                        {{ \Laravel\Nova\Nova::name() }}
                    </a>
                </div>
                <div class="hidden md:flex">
                    <a v-if="@json(\Laravel\Nova\Nova::name() !== null)" href="{{ \Illuminate\Support\Facades\Config::get('nova.url') }}" class="no-underline dim font-bold text-90 mr-6">
                        {{ \Laravel\Nova\Nova::name() }}
                    </a>
                </div>

                {{-- @if (count(\Laravel\Nova\Nova::globallySearchableResources(request())) > 0)
                    <global-search dusk="global-search-component"></global-search>
                @endif --}}

                <dropdown class="ml-auto h-9 flex items-center dropdown-right">
                    @include('nova::partials.user')
                </dropdown>
            </div>

            <div data-testid="content" class="px-view py-view mx-auto">
                @yield('content')
            </div>
        </div>-->
        <div class="block sm:hidden w-screen flex justify-center items-center">
            Not compatile to mobile view
        </div>
            <!-- Content -->
            <div class="content mx-auto hidden sm:block">
                <div class="flex items-center relative  h-header z-20 px-view">

                    <div class="flex items-center gap-4">
                        <a v-if="@json(\Laravel\Nova\Nova::name() !== null)" href="/" class="no-underline  font-bold text-90 mr-6">
                            {{ \Laravel\Nova\Nova::name() }}
                        </a>
                        <a v-if="@json(\Laravel\Nova\Nova::name() !== null)" href="/app/dashboards/main" class="flex items-center gap-2 no-underline  text-90">
                            {{-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                              </svg> --}}
                              Dashboard
                        </a>
                        <router-link class="text-primary-900" :to="{
                            name: 'index',
                            params: {
                                resourceName: 'bookings'
                            }
                        }" class="text-white text-justify no-underline dim" >
                            Bookings
                        </router-link>
                        <router-link class="text-primary-900" :to="{
                            name: 'index',
                            params: {
                                resourceName: 'medical-records'
                            }
                        }" class="text-white text-justify no-underline dim" >
                            Records
                        </router-link>
                        <router-link class="text-primary-900" :to="{
                            name: 'index',
                            params: {
                                resourceName: 'services'
                            }
                        }" class="text-white text-justify no-underline dim" >
                            Services
                        </router-link>

                        {{-- <router-link class="text-primary-900" :to="{
                            name: 'index',
                            params: {
                                resourceName: 'payment-orders'
                            }
                        }" class="text-white text-justify no-underline dim" >
                            Payment Orders
                        </router-link> --}}

                        <router-link class="text-primary-900" :to="{
                            name: 'index',
                            params: {
                                resourceName: 'billings'
                            }
                        }" class="text-white text-justify no-underline dim" >
                            Billing
                        </router-link>

                        @if (auth()->user()->type != 'Patient')
                            <router-link class="text-primary-900" :to="{
                                name: 'index',
                                params: {
                                    resourceName: 'users'
                                }
                            }" class="text-white text-justify no-underline dim" >
                                Users
                            </router-link>
                        @endif


                    </div>




                    {{-- @if (count(\Laravel\Nova\Nova::globallySearchableResources(request())) > 0)
                        <global-search dusk="global-search-component"></global-search>
                    @endif --}}

                    <dropdown class="ml-auto h-9 flex items-center dropdown-right">
                        @include('nova::partials.user')
                    </dropdown>
                </div>

                <div data-testid="content" class="px-view py-view mx-auto">
                    @yield('content')

                </div>
            </div>
        </div>
    </div>

    @include('nova::partials.footer')

    <script>
        window.config = @json(\Laravel\Nova\Nova::jsonVariables(request()));
    </script>

    <!-- Scripts -->
    <script src="{{ mix('manifest.js', 'vendor/nova') }}"></script>
    <script src="{{ mix('vendor.js', 'vendor/nova') }}"></script>
    <script src="{{ mix('app.js', 'vendor/nova') }}"></script>

    <!-- Build Nova Instance -->
    <script>
        window.Nova = new CreateNova(config)
    </script>

    <!-- Tool Scripts -->
    @foreach (\Laravel\Nova\Nova::availableScripts(request()) as $name => $path)
        @if (\Illuminate\Support\Str::startsWith($path, ['http://', 'https://']))
            <script src="{!! $path !!}"></script>
        @else
            <script src="/nova-api/scripts/{{ $name }}"></script>
        @endif
    @endforeach

    <!-- Start Nova -->
    <script>
        Nova.liftOff()
    </script>
</body>
</html>
