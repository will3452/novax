<!DOCTYPE html>
<html lang="en" data-theme="cupcake">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{config('app.name', 'Nuwang')}}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- <meta http-equiv="refresh" content="1"> --}}

     {{-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2/dist/tailwind.min.css" rel="stylesheet" type="text/css" /> --}}
</head>
<body>
    <div class="relative w-screen h-screen overflow-auto">
        {{$slot}}
    </div>
</body>
</html>
