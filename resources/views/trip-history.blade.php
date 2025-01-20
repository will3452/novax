<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="space-y-4 p-2 overflow-y-auto h-[90vh]">
        <div class="flex gap-2 items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
              </svg>

              <h1 class="font-bold text-xl">Trip History</h1>
        </div>
       <div class="space-y-2">
        @foreach ($records as $item)
            <div class="p-4  w-full  rounded-md  space-y-4 border bg-white">
                <div class="grid grid-cols-2 items-center gap-2 justify-between">
                    <div class="flex gap-2 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                          </svg>

                        <h1 class="font-bold text-lg text-gray-700">{{$item->model}}</h1>
                    </div>
                    <div class="text-xs text-right">
                        {{$item->date->format('m/d/y')}}
                    </div>
                    <div class="flex gap-2 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                          </svg>
                        <h1 class="text-xs ">{{$item->driver ? $item->driver->first_name . " " . $item->driver->last_name : '---'}}</h1>
                    </div>
                    <div class="text-right text-xs">
                        Capacity: {{$item?->vehicle?->capacity}}
                    </div>
                    <div class="flex gap-2 items-start col-span-2 line-clamp-3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                          </svg>
                        <h1 class="text-xs ">{{$item->purpose}}</h1>
                    </div>
                </div>
                <div class="grid grid-cols-4 gap-1">
                    <a href="/feedback/{{$item->id}}" class=" rounded-md bg-purple-900 p-2 text-center text-green-100">Feedback</a>
                    <a href="/mobile-view-request/{{$item->id}}" class=" rounded-md bg-green-900 p-2 text-center text-green-100">Ticket</a>
                    @if ($item->p_lat != null && $item->p_long != null && $item->d_lat != null && $item->d_long )
                    <a href="/map/{{$item->id}}" class=" rounded-md bg-blue-900 p-2 text-center text-blue-100">Route</a>
                    @else
                    <a href="#" class=" rounded-md bg-gray-200 p-2 text-center text-gray-900">Route</a>
                    @endif
                    @if ($item->driver_id)
                        <a href="/chat/{{$user->id}}/{{$item->driver_id}}" class=" rounded-md bg-yellow-900 p-2 text-center text-yellow-100">Message</a>
                    @else
                    <a href="#" class=" rounded-md bg-gray-200 p-2 text-center text-gray-900">Message</a>
                    @endif
                </div>
            </div>
        @endforeach
       </div>
    </div>
    <x-back-home></x-back-home>
</body>
</html>
