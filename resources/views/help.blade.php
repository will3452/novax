<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="space-y-4 p-2 overflow-y-auto h-[90vh]">
        <h1 class="text-2xl font-bold">Help</h1>
        <div>
            {!!nova_get_setting('help', '---')!!}
        </div>
    </div>
    <x-back-home></x-back-home>
</body>
</html>
