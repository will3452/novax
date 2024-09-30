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
            Date: <input name="created_at" type="date">
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
                    <input type="checkbox" name="model[]" value="{{$item->model}}"/> {{$item->model}}
                </div>
            @endforeach
        </div>
        <div>
            <div>
                Purpose/s:
            </div>
            <textarea name="purpose" class="border rounded-md w-full mt-2 h-[50px] p-2" placeholder="Aa"></textarea>
        </div>
        <div>
            Date of Travel: <input type="date" name="date" required />
        </div>
        <div class="overflow-y-auto">
            <table class="w-full border">
                <thead>    
                    <tr>
                       <th class="border text-gray-800">
                            Passenger/s
                        </th>
                        <th class="border text-gray-800">
                            Organization
                        </th> 
                        <th class="border text-gray-800">
                            Destination/s
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < 5; $i++)
                    <tr>
                        <td class="border p-2">
                            <input name="passenger[]"/>
                        </td>
                        <td class="border p-2">
                            <input name="organization[]" />
                        </td>
                        <td class="border p-2" >
                            <input name="destination[]" />
                        </td>
                    </tr>
                    @endfor
                </tbody>
            </table>
        </div>
        <div class="space-y-2">
            <div>
                Upload Request Travel
            </div>
            <input name="request_travel" type="file" />
        </div>
        <div class="space-y-2">
            <div>
                Upload Travel Order
            </div>
            <input name="travel_order" type="file" />
        </div>
        <div class="flex gap-2">
            <div class="flex gap-2 items-center">
                <input type="radio" name="status" value="approved"/> Approved
            </div>
            <div class="flex gap-2 items-center">
                <input type="radio" name="status" value="declined"/> Declinded
            </div>
        </div>
        <div>
            <div>
                Noted By: 
            </div>
            <div>
                {{nova_get_setting('vehicle_request_form_authorizer', 'Dr. Federick T. Villa')}}
            </div>
        </div>
        <div>
            <button type="submit" class="bg-blue-900 text-white p-4 font-bold text-lg rounded-full w-full">Submit</button>
        </div>
    </form>
</body>
</html>