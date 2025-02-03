<x-auth>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1>
                Notifications
            </h1>
            <a href="{{route('notifications.read.all')}}" class="btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 6h12M6 12h12M4 18h12"/></svg>
                Mark all as Read
            </a>
        </div>
        @forelse (auth()->user()->notifications as $item)
            <div class="card mt-2">
                <div class="card-header">
                    {{$item->created_at->diffForHumans()}}
                </div>
                <div class="card-body">
                    {{$item->data['message']}}
                </div>
                <div class="card-footer">
                    <div class="d-flex gap-2">
                        @if (is_null($item->read_at))
                            <a class="btn btn-success" href="{{route('notifications.read', $item->id)}}">Mark as read</a>
                        @endif
                        @if (array_key_exists('actions', $item->data))
                            @if (is_array($item->data['actions']))
                                @foreach ($item->data['actions'] as $a)
                                    @if (is_array($a))
                                        <a href="{{$a['action']}}" class="btn {{$a['color']}}">
                                            {{$a['label']}}
                                        </a>
                                    @endif
                                @endforeach
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div>
                No Notifications..
            </div>
        @endforelse
    </div>
</x-auth>
