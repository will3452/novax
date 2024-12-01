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
    <div class="p-2 space-y-4">
        <h1 class="text-lg font-bold flex gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m6.75 12-3-3m0 0-3 3m3-3v6m-1.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
              </svg> Vehicle Request Form</h1>

        <form method="POST" action="/form-request" enctype="multipart/form-data" class="space-y-3">
            <div class="space-y-2">

                <input type="hidden" name="user_id" value="{{$user->id}}" />
                <label for="" class="font-bold">Select Service Vehicle: </label>
                <div class="grid grid-cols-2 gap-2">
                    @foreach ($vehicles as $item)
                        <div class=" flex items-center gap-2">
                            <input type="checkbox" name="model[]" value="{{$item->model}}"/> {{$item->model}}
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="space-y-2">
                <label for="" class="font-bold">Purpose:</label>
                <textarea name="purpose" id="" class="border-2 block w-full p-2 rounded-xl"></textarea>
            </div>
            <div class="space-y-2">
                <label for="" class="font-bold">Date of Travel:</label>
                <input type="date" class="block border-2 w-full p-2 rounded-xl" name="date" />
            </div>
            <div>
                <div class="overflow-y-auto border rounded-xl">
                    <table class="w-full border">
                        <thead>
                            <tr>
                               <th class="border text-gray-800 p-2">
                                    Passenger/s
                                </th>
                                <th class="border text-gray-800 p-2">
                                    Organization
                                </th>
                                <th class="border text-gray-800 p-2">
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
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="border border-dashed space-y-2 truncate flex flex-col justify-center p-2 rounded-xl">
                    <div class="font-bold">
                        Upload Request Travel
                    </div>
                    <input class="text-xs" name="request_travel" type="file" />
                </div>
                <div class="border border-dashed space-y-2 truncate flex flex-col justify-center p-2 rounded-xl">
                    <div class="font-bold">
                        Upload Travel Order
                    </div>
                    <input class="text-xs" name="travel_order" type="file" />
                </div>
            </div>
            @csrf
            <button class="bg-blue-900 text-white rounded-md px-4 py-2 shadow-md w-full">Submit</button>
        </form>
    </div>
    <x-back-home/>
</body>
</html>
