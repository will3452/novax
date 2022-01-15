@props(['id'])
<div id="{{$id}}" class="w-full carousel-item" style="max-height: 60vh;">
    {{$slot}}
</div>

{{-- slot must be like this
    <img src="https://picsum.photos/id/500/800/300" class="w-full">
    --}}
