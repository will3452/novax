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
    <form action="/new-request" method="POST" enctype="multipart/form-data" class="space-y-4 p-2 h-[90vh]">
        @csrf
        <h1 class="font-bold flex gap-2 items-center">
              Travel Order
        </h1>
        <div>
            <label for="">No: </label>
            <span class="font-bold"># 00001</span>
        </div>
        <div>
            <label for="">Unit *</label>
            <input type="text" name="unit" required class="w-full border-2 rounded-md p-2">
        </div>
        <div>
            <label for="">Destination</label>
            <input type="text" name="destination" required required class="w-full border-2 rounded-md p-2">
        </div>
        <div>
            <label for="">Date of Travel</label>
            <input type="date" name="dot" required required class="w-full border-2 rounded-md p-2">
        </div>
        <div>
            <label for="">Purpose</label>
            <input type="text" name="purpose" required required class="w-full border-2 rounded-md p-2">
        </div>

        <div>
            <label for="">Entitled options</label>
            <div>
                <input type="checkbox" value="Per Diem" name="option"> Per Diem
            </div>
            <div>
                <input type="checkbox" value="Actual allowable travel expenses" name="option">  Actual allowable travel expenses
            </div>
        </div>
        <button class="bg-blue-900 text-white w-full p-4 rounded-full font-bold">SUBMIT</button>
        <div class="h-[150px]"></div>
    </form>
    <x-back-home></x-back-home>
</body>
</html>
