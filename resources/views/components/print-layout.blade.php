<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>  </head>
</head>
<body class="bg-gray-400 print:bg-white">
    <div class="relative">
        <a class="print:hidden p-2 border absolute right-0 bg-white uppercase font-bold" href="{{url()->previous()}}">back to application</a>
    </div>
    {{$slot}}
</body>
<script>
    window.print()
</script>
</html>
