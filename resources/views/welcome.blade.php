<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Interface</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <style>
        @page {
            size:A4;
        }
        @media print {
            body, html{
                padding: 0px;
                margin: 0px;
            }
        }
    </style>
</head>
<body class="flex justify-center items-center w-screen h-screen">
    <h1 class="font-bold uppercase tracker-2 text-3xl text-gray-800">
        UNDER DEVELOPMENT
    </h1>
</body>
</html>
