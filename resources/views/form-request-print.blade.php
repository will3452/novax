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
    <form method="post" action="/form-request" enctype="multipart/form-data" class="p-4 text-xs space-y-4">
        @csrf
        <input type="hidden" name="user_id" value="{{$user->id}}" />
        <div>
            <span class="font-bold">Date:</span> {{$fr->created_at->format('m/d/y')}}
        </div>
        <div class=" mb-4">
            Ma'am/Sir,
        </div>
        <div class="xs">
            I/We would like to request for Authority to use SLSU Service Vehicle.
        </div>
        <div class="grid grid-cols-2 gap-2 my-4">
            <div>
                {{$fr->model}}
            </div>
        </div>
        <div>
            <div class="font-bold">
                Purpose/s:
            </div>
            {{$fr->purpose}}
        </div>
        <div>
            <span class="font-bold">Date of Travel: </span> {{$fr->date->format('m/d/y')}}
        </div>
        <div class="font-bold">
            Details:
        </div>
        {!!$fr->remarks!!}
        <div class="space-y-2">
            <div>
                Upload Request Travel
            </div>
            <img src="/storage/{{$fr->request_travel}}"  class="w-[100px] h-[100px] object-fit" alt="">
        </div>
        <div class="space-y-2">
            <div>
                Upload Travel Order
            </div>
            <img src="/storage/{{$fr->travel_order}}"  class="w-[100px] h-[100px] object-fit" alt="">
        </div>
        <div class="relative">
            <div>
                Noted By:
            </div>
            <img src="/storage/{{$fr->signature}}" alt="" class="w-[100px]">
            <div>
                {{nova_get_setting('vehicle_request_form_authorizer', 'Dr. Arvin N. Natividad')}}
            </div>
        </div>
    </form>
    <script>
        window.print()
    </script>
</body>
</html>
