<!DOCTYPE html>
<html lang="en" data-theme="wireframe">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{config('app.name', 'Nuwang')}}</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.3.6/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <x-navbar></x-navbar>
    {{$slot}}
</body>
</html>
