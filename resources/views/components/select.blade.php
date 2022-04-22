@props(['label' => '', 'name' => '', ])
<div class="input-group-outline my-3">
    <span class="form-label">{{$label}}</span>
    <select name="{{$name}}" required class="px-2 form-control border">
        {{$slot}}
    </select>
</div>
