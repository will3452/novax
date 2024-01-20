<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME', 'Tourism Website') }}</title>
    <link rel="stylesheet" href="/css/app.css">
    <script src="/js/app.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inder&family=Instrument+Serif&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Rubik+Doodle+Shadow&display=swap" rel="stylesheet">
<style>
    .font-custom {
        font-family: 'Instrument Serif', serif;
    }
</style>
</head>
<body>
    {{$slot}}
</body>
</html>