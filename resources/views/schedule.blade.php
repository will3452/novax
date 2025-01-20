<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">
    <style>
        .pika-lendar {
            width: 95%;
        }
    </style>
</head>
<body class="bg-gray-200">
    <div id="datepicker"></div>
    <div class="p-2">
        <h1 class="font-bold text-gray-600">Upcoming Trip</h1>
        <div class="space-y-4 mt-4">
            @forelse ($records as $item)
                <div class="bg-white border p-4 rounded-md">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="font-bold">
                                {{$item->date->format('Y-m-d')}}, {{$item->time}}
                            </div>
                            <div>
                                purpose: {{$item->purpose}}
                            </div>
                            <div class="text-xs">
                                Requestor: {{$item->user->name}}
                            </div>
                        </div>
                        <a href="/map/{{$item->id}}">
                            View Route
                        </a>
                    </div>
                </div>
            @empty
            <div class="text-gray-600 text-center bg-gray-200 p-4 rounded-xl">
                No Schedule.
            </div>
            @endforelse
        </div>
    </div>
    <x-back-home></x-back-home>
    <script>
        var field = document.getElementById('datepicker');
        var picker = new Pikaday({
            onSelect: function(date) {
                field.value = picker.toString();
            }
        });
        field.parentNode.insertBefore(picker.el, field.nextSibling);
    </script>
</body>
</html>
