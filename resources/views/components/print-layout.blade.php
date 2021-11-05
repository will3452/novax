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
                Small and Medium-Sized Enterprises
            </h1>
            <h1 class="font-bold">
                MH Del Pilar St, Tarlac City
            </h1>
            <h1 class="font-bold">
                Daniel Dy - Proprietor
            </h1>
            <div class="text-sm font-bold mt-4">
                {{$title}}
            </div>
        </div>
        <div class="w-full mt-4" style="font-size:9px;">
            {{$slot}}
        </div>
    </div>

    <script>
        window.onload = function(){
            window.print();
        }

        window.onafterprint = function(){
            window.close();
        }
    </script>
</body>
</html>
