<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full font-sans antialiased">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ \Laravel\Nova\Nova::name() }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,800,800i,900,900i" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('app.css', 'vendor/nova') }}">

    <style>
        :root {
  --primary: #83BD75;
  --primary-dark: #4E944F;
  --primary-70: #B4E197;
  --primary-50: #E9EFC0;
  --primary-30: #E9EFC9;
  --primary-10: #E9EFC1;
  --logo: #83BD75;
  --sidebar-icon: #fff;
}

.bg-grad-sidebar {
  background-image: -webkit-gradient(
    linear,
    left bottom,
    left top,
    from(#83BD75),
    to(#4E944F)
  );

  background-image: linear-gradient(
    0deg,
    #83BD75,
    #4E944F
  );
}
.bg-40  {
    background: #E9EFC0 !important;
}

.h-header {
    background: #83BD75 !important;
}

.dark-mode-toggle {
    background: #83BD75 !important;
}
button[dusk='create-and-add-another-button'] {
    display:none !important;
}
/* * {
    border-radius: 0px !important;
} */

    </style>

    <!-- Theme Styles -->
    @foreach(\Laravel\Nova\Nova::themeStyles() as $publicPath)
        <link rel="stylesheet" href="{{ $publicPath }}">
    @endforeach
</head>
<body class="bg-40 text-black h-full">
    <div class="h-full">
        <div class="px-view py-view mx-auto">
            @yield('content')
        </div>
    </div>
</body>
</html>
