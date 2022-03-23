@props(['id' => \Str::random(4), 'button'=>'send', 'room' => null, 'feedbackId'=>null, 'subject' => null])
<label for="{{$id}}" class="fixed bottom-2 right-2 btn btn-primary btn-xs">
    Write feedback.
</label>
<input type="checkbox" id="{{$id}}" class="modal-toggle">
<div class="modal">
<div class="modal-box">
    <h3 class="font-bold text-lg">Write Feedback</h3>
    <form action="/submit-feedback" class="mt-4" method="POST">
        @csrf
        @if (! is_null($feedbackId))
            <input type="hidden" name="reply_to_feedback_id" value="{{$feedbackId}}">
        @endif
        <input type="hidden" name="subject_id" value="{{$subject->id}}"/>
        <input type="hidden" name="room_id" value="{{$room->id}}"/>
        <textarea name="message" required class="w-full textarea-bordered textarea" placeholder="Aa"></textarea>
        <button class="btn btn-sm mt-4">{{$button}}</button>
    </form>
    <div class="modal-action">
    <label for="{{$id}}" class="btn btn-sm">Cancel</label>
    </div>
</div>
</div>
