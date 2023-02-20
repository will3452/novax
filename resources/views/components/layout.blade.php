
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

    <!-- CSS
	============================================ -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <!-- Icon Font CSS -->
    <link rel="stylesheet" href="/assets/css/icons.min.css">
    <!-- Plugins CSS -->
    <link rel="stylesheet" href="/assets/css/plugins.css">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">

<script src="/assets/js/vendor/jquery-v3.6.0.min.js"></script>
<script src="/assets/js/vendor/jquery-migrate-v3.3.2.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
</head>

<body>

    @include('sweetalert::alert')

    {{$slot}}


<!-- All JS is here
============================================ -->

<script src="/assets/js/vendor/modernizr-3.11.7.min.js"></script>
<script src="/assets/js/vendor/popper.min.js"></script>
<script src="/assets/js/vendor/bootstrap.min.js"></script>
<script src="/assets/js/plugins.js"></script>
<!-- Ajax Mail -->
<script src="/assets/js/ajax-mail.js"></script>
<!-- Main JS -->
<script src="/assets/js/main.js"></script>

</body>

</html>
