@props(['label' => '', 'name' => '', 'type' => 'text', 'value' => null, 'required' => 1])
<div class="input-group input-group-outline mb-3">
    <span class="form-label">{{$label}}</span>
    <input type="{{$type}}" name="{{$name}}" value="{{$value ?? old($name)}}"  {{$required ? 'required' : ''}} class="form-control">
</div>
