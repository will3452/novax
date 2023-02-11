<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .par {
            text-indent: 100px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <header class="flex items-center justify-between p-4 px-10">
        <img src="/logo/l.png"  style="width:100px;" alt="">
        <div class="text-center font-serif">
            <h1 class="font-bold">REPUBLIC OF THE PHILIPPINES</h1>
            <h2 class="text-sm">PROVINCE OF ISABELA</h2>
            <h2 class="text-sm">MUNICIPALITY OF ECHAGUE</h2>
            <h2 class="text-sm">BARANGAY GUCAB</h2>
        </div>
        <img src="/logo/r.png"  style="width:100px;" alt="">
    </header>
    {{$slot}}
    <script>
        window.print()
    </script>
</body>
</html>
