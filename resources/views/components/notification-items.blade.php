@foreach (auth()->user()->notifications as $notification)
<div class="alert mt-2">
    <div class="flex-1">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="#009688" class="flex-shrink-0 w-6 h-6 mx-2">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
      </svg>
      <label>
        <p class="text-sm text-base-content text-opacity-60">
            {{$notification->data['message']}}
            <span class="text-xs font-bold text-gray-500 block">
                {{$notification->created_at->diffForHumans()}}
            </span>
        </p>
      </label>
    </div>
    <div class="flex-none">
        <notification-button readat="{{$notification->read_at}}" notificationid="{{$notification->id}}"></notification-button>
    </div>
  </div>
@endforeach
