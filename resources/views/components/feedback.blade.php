@props(['key' => '', 'id' => \Str::random(8), 'feedback' => [], 'subject' => [],'room' => null, 'root' => true, 'count'=>0, 'canReply' => true,])
<div x-data="{open:{{$root ? 0 : 1}}}">
    @if ($root)
    <div class="flex justify-between">
        <span class="font-bold">
            {{$key}}
        </span>
        <button x-on:click="open = !open" class=" btn btn-xs my-4 rounded-none bg-black text-white">-</button>
    </div>
@endif
<x-table-container>
    <div x-bind:class="{'hidden':! open}">
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
                            <x-write-feedback  :subject="$subject" button="reply" id="{{$fb->id}}" :room="$room" :feedback-id="$fb->id"></x-write-feedback>
                        </div>
                    @endif
                </div>
                <div class="pl-2">
                    <x-feedback :subject="$subject" :count="$fb->replies()->count()" :root="false" :room="$room" :feedback="$fb->replies()->latest()->get()"></x-feedback>
                </div>
            </div>
    @endforeach
    </div>
</x-table-container>
</div>
