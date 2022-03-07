@props(['feedback' => [], 'room' => null, 'root' => true, 'count'=>0, 'canReply' => true,])
@if ($root)
    <button onclick="toggle()" class="btn btn-xs my-4">Show/Hide Feedback </button>
@endif
<x-table-container>
    <div id="root-con">
        @foreach ($feedback as $fb)
            <div class="mt-4 border-t-2 border-2 border-r-0 p-2 pr-0">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-xs">
                            {{$fb->user->name}}
                        </div>
                         - {{$fb->message}}
                         <div class="text-xs">
                             [{{$fb->created_at->format('m d, Y h:i A')}}]
                         </div>
                    </div>
                    @if ($canReply)
                        <div>
                            <label for="{{$fb->id}}" class="btn btn-xs">reply</label>
                            <x-write-feedback  button="reply" id="{{$fb->id}}" :room="$room" :feedback-id="$fb->id"></x-write-feedback>
                        </div>
                    @endif
                </div>
                <div class="pl-2">
                    <x-feedback :count="$fb->replies()->count()" :root="false" :room="$room" :feedback="$fb->replies()->latest()->get()"></x-feedback>
                </div>
            </div>
    @endforeach
    </div>
</x-table-container>

<script>
    var rootCon = document.getElementById('root-con');
    var isHide = false;
    function toggle() {
        if (! isHide) {
            rootCon.classList.add('hidden');
        } else {
            rootCon.classList.remove('hidden');
        }
        isHide = !isHide;
    }
</script>
