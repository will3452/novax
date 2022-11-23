@props(['name' => '', 'label' => '', 'help' => '', 'required' => false, 'type' => 'text', 'value' => null])
<div class="form-group">
    <label>{{$label}} <span class="text-danger">{{ $required ? '*' : ''}}</span></label>
    <input type="{{$type}}"  class="form-control" name="{{$name}}" value="{{$value ?? old($name)}}" {{$required ? 'required' : ''}}>
    <p class="help-block">{{$help}}</p>
    @error($name)
        <small class="text-danger">
            {{$message}}
        </small>
    @enderror
</div>
