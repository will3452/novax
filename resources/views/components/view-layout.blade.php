@props(['title'=>''])
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
<body>
    <div class="bg-white mx-auto my-5">
        <div class="text-center text-lg">
            <h1 class="font-bold">
                {{nova_get_setting('company_name')}}
            </h1>
            <h1 class="font-bold">
                {{nova_get_setting('address')}}
            </h1>
            <h1 class="font-bold">
                {{nova_get_setting('owner')}}
            </h1>
            <div class="text-sm font-bold mt-4">
                {{$title}}
            </div>
        </div>
        <div class="w-11/12 mx-auto mt-4">
            {{$slot}}
        </div>
    </div>
</body>
</html>
