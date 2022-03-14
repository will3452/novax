@props(['extra' => '', 'button' => 'ok', 'id'=>\Str::random(16)])
<!-- The button to open modal -->
<label for="{{$id}}" class="btn modal-button {{$extra}}">{{$button}}</label>

<!-- Put this part before </body> tag -->
<input type="checkbox" id="{{$id}}" class="modal-toggle">
<div class="modal">
  <div class="modal-box">
    {{$slot}}
    <div class="modal-action">
      <label for="{{$id}}" class="btn">Cancel</label>
    </div>
  </div>
</div>
