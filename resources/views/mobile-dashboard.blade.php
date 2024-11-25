<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-2">
    @include('sweetalert::alert')
    <div class="space-y-4">
        <div class="bg-gray-200 p-2 px-4 rounded-md shadow-md">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-2xl font-bold">
                        {{now()->format('M d, Y')}}
                    </div>
                    <div class="">
                        Hello {{auth()->user()->name}}
                    </div>
                </div>
                <div>
                    <a href="{{url()->current()}}">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                          </svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-4">
            <x-dashboard-item :image="'car-rental.png'" :route="'/form-request/' . auth()->id()">
                Request
            </x-dashboard-item>
            <x-dashboard-item :image="'calendar-page.png'" :route="'/schedule/' . auth()->id() . '?type=' . auth()->user()->type">
                My Schedule
            </x-dashboard-item>
            <x-dashboard-item :image="'packing-list.png'"  :route="'/trip-history/' . auth()->id()">
                Trip History
            </x-dashboard-item>
            <x-dashboard-item :image="'mail.png'" :route="'/inbox/' . auth()->id()">
                Messages
            </x-dashboard-item>
            <x-dashboard-item :image="'map.png'" :route="'/default-map'">
                Map
            </x-dashboard-item>
            <x-dashboard-item :image="'profile.png'" :route="'#'">
                My Account
            </x-dashboard-item>
            <x-dashboard-item :image="'info.png'" :route="'#'">
                Help
            </x-dashboard-item>
        </div>
        <x-back-home></x-back-home>
    </div>
</body>
</html>
