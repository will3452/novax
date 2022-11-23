@props(['name' => '', 'label' => '', 'help' => '', 'required' => false, 'type' => 'text', 'value' => null])
<div class="form-group">
    <label>{{$label}} <span class="text-danger">{{ $required ? '*' : ''}}</span></label>
    <textarea name="{{$name}}" id=""  rows="5" class="form-control"  {{$required ? 'required' : ''}} > {{$value ?? old($name)}} </textarea>
    <p class="help-block">{{$help}}</p>
    @error($name)
        <small class="text-danger">
            {{$message}}
        </small>
    @enderror
</div>
