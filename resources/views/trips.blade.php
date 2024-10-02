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
    <div class="p-4 space-y-4">
        @foreach ($trips as $trip)
            <div class="border rounded-md p-4 space-y-4">
                <div class="flex gap-4">
                    <div class="w-1/3 border-r-2 border-red-600 text-center relative">
                        <div class="h-[12px] border-2 border-red-600 bg-white w-[12px] rounded-full top-0 -right-2 absolute"></div>
                        <div class="h-[12px] border-2 border-red-600 bg-white w-[12px] rounded-full bottom-0 -right-2 absolute"></div>
                        <div class="text-gray-800 font-bold relative mb-4">
                            {{$trip->pickup_time}}
                        </div>
                        <div class="text-gray-800 font-bold relative">
                            {{$trip->dropoff_time}}
                        </div>
                    </div>
                    <div class="w-2/3 text-xs space-y-2">
                        <div>
                            {{$trip->pickup_location}}
                        </div>
                        <div>
                            {{$trip->vehicle->capacity}} seats
                        </div>
                        <div>
                            {{$trip->dropoff_location}}
                        </div>
                    </div>
                </div>
                <div class="flex gap-2 text-xs items-center justify-between">
                    <div class="flex gap-2 text-xs items-center">
                        <img src="/image-circle.png" class="w-[25px]"/>
                        <div>
                            <div class="font-bold text-gray-800">
                                {{$trip->vehicle->driver->first_name}} {{$trip->vehicle->driver->last_name}}
                            </div>
                            <div>
                                {{$trip->vehicle->driver->employee_no}}
                            </div>
                        </div>
                    </div>
                    <div>
                        <div>
                            <div class="flex gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                                  </svg>
                                {{$trip->vehicle->model}}
                            </div>
                            <div class="flex gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                                  </svg>

                                {{$trip->vehicle->driver->phone}}
                            </div>

                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-4">
                    <a href="/reserve/{{$user->id}}/{{$trip->id}}" class="text-center bg-green-600 text-white border-none p-2 uppercase font-bold font-bold rounded-full">
                        Reserve
                    </a>
                    <a href="/map/{{$trip->id}}" class="text-xs flex items-center justify-center block text-center bg-blue-900 text-white border-none p-2 uppercase font-bold rounded-full">
                        View in Map
                    </a>
                    <a href="/chat/{{$user->id}}/{{$trip->vehicle->driver->user->id}}" class="text-xs flex items-center block text-center bg-orange-500 text-white border-none p-2 uppercase font-bold rounded-full">
                        Message Driver
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</body>
</html>
