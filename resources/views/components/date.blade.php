@props(['label' => '', 'name' => '', 'type' => 'text', 'value' => null, 'required' => 1])
<div class=" input-group-outline my-3">
    <span class="form-label">{{$label}}</span>
    <input type="{{$type}}" name="{{$name}}" value="{{$value ?? old($name)}}"  {{$required ? 'required' : ''}} class="form-control border px-3">
</div>
