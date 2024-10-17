<head>
    <link rel="icon" type="image/svg+xml" href="/storage/{{nova_get_setting('logo',)}}" />
    <title>{{env('APP_NAME')}}</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="md:w-1/2 mx-auto space-y-4 mt-4">
        <div class="flex justify-between items-center">
            <h1 class="font-bold text-2xl">Notifications</h1>
            <a href="/home" class="underline">Back to Home</a>
        </div>
        <div class="space-y-2">
            @forelse (auth()->user()->unreadNotifications as $item)
                <div class=" shadow-md p-2 rounded-md border">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center gap-2">
                            @if ($item->data['status'] == 'success')
                            <div class="w-[40px] h-[40px] bg-green-300 text-green-800 rounded-full p-2">

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                </svg>
                            </div>
                            @endif
                            {{$item->data['message']}}
                        </div>
                        <form method="post" action="/admin-notifications/{{$item->id}}">
                            @csrf
                            <button class="p-2  bg-green-100 text-xs">Mark as read</button>
                        </form>
                    </div>

                </div>
            @empty
                <div class="text-center p-2 rounded-md bg-gray-200">
                    No Notification available
                </div>
            @endforelse
        </div>
    </div>
</body>
