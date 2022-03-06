@props(['feedback' => [], 'room' => null, 'root' => true, 'count'=>0])
<x-table-container>
    @foreach ($feedback as $fb)
        @if (!$root)
        <details>
        <summary>{{$count}} replies</summary>
        @endif
            <div class="mt-4 border-t-2 border-2 border-r-0 p-2 pr-0">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-xs">
                            {{$fb->user->name}}
                        </div>
                         - {{$fb->message}}
                         <div class="text-xs">
                             [{{$fb->created_at->format('m d, Y H:i A')}}]
                         </div>
                    </div>
                    <div>
                        <label for="{{$fb->id}}" class="btn btn-xs">reply</label>
                        <x-write-feedback  button="reply" id="{{$fb->id}}" :room="$room" :feedback-id="$fb->id"></x-write-feedback>
                    </div>
                </div>
                <div class="pl-2">
                    <x-feedback :count="$fb->replies()->count()" :root="false" :room="$room" :feedback="$fb->replies()->latest()->get()"></x-feedback>
                </div>
            </div>
        @if (!$root)
        </details>
        @endif
    @endforeach
</x-table-container>
