<!DOCTYPE html>
<html lang="en" data-theme="lemonade">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{config('app.name', 'Nuwang')}}</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.24.2/dist/full.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2/dist/tailwind.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/particlesjs/2.2.2/particles.min.js"></script>
    <style>
        html, body {

            margin
            : 0;

            padding
            : 0;
            }
            .background {

            position
            :
            absolute
            ;

            display
            :
            block
            ;

            top
            : 0;

            left
            : 0;

            z-index
    </style>
</head>
<body>
    <canvas class="background">

    </canvas>

    {{$slot}}

    <script>
        window.
            onload
            = function() {
            Particles.
            init
            ({
                selector:'.background',
                color: '#529B03'
            });
        };

    </script>
</body>
</html>
