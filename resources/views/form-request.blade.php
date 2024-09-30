<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="p-4 text-xs space-y-4">
        <div>
            Date: <input type="date">
        </div>
        <div class=" mb-4">
            Ma'am/Sir, 
        </div>
        <div class="xs">
            I/We would like to request for Authority to use SLSU Service Vehicle.
        </div>
        <div class="grid grid-cols-2 gap-2 my-4">
            @foreach ($vehicles as $item)
                <div class=" flex items-center gap-2">
                    <input type="checkbox" name="model" value="{{$item->model}}"/> {{$item->model}}
                </div>
            @endforeach
        </div>
        <div>
            <div>
                Purpose/s:
            </div>
            <textarea class="border rounded-md w-full mt-2 h-[50px] p-2" placeholder="Aa"></textarea>
        </div>
        <div>
            Date of Travel: <input type="date" />
        </div>
    </div>
</body>
</html>