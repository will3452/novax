<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EICC</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Rubik+Doodle+Shadow&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inder&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Rubik+Doodle+Shadow&display=swap" rel="stylesheet">
    <style>
        body,html {
            scroll-behavior: smooth;
            padding:0px;
            margin:0px;
            background: #1E2724; 
            font-family: inter; 
        }

        .bg-dark {
            background: #1E2724; 
        }

        .bg-primary {
            background: #F6A757; 
        }
        .color-primary {
            color: #F6A757; 
        }

        .border-primary {
            border-color: #F6A757; 
        }

        .hero {
            background: url('/hero.png'); 
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .font-inder {
            font-family: inder; 
        }
    </style>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    @livewireStyles
</head>
<body>
    {{$slot}}
    <script>
        AOS.init();
    </script>
    @livewireScripts
</body>
</html>