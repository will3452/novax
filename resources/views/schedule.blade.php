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
<body>
    <div id="datepicker"></div>
    <div class="p-2">
        <h1 class="font-bold text-gray-600">Reminder</h1>
        <div class="space-y-4 mt-4">
            @forelse ($reservations as $item)
                <div class="flex gap-2 bg-green-700 p-4 rounded-xl shadow-md">
                    <div class="w-[50px] h-[50px] flex items-center justify-center bg-[#BAB0F9] rounded-xl">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                        </svg>
                    </div>
                    <div class="text-white w-2/3">
                        <div>
                            {{$item->trip->pickup_location}} - {{$item->trip->dropoff_location}}
                        </div>
                        <div class="text-xs">
                            {{$item->date->format('m/d/Y')}} - {{$item->trip->pickup_time}} - {{$item->trip->dropoff_time}}
                        </div>
                    </div>
                </div>
            @empty
            <div class="text-gray-600 text-center bg-gray-200 p-4 rounded-xl">
                No Schedule.
            </div>
            @endforelse
        </div>
    </div>
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
