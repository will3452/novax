@props(['label' => '', 'name' => '', 'required' => false, 'yesText' => 'Yes', 'noText' => 'No', 'yesValue' =>'1', 'noValue' => '0', 'checked' => ''])
<div class="form-group">
    <label>{{$label}} <span class="text-danger">{{ $required ? '*' : ''}}</span></label>
    <div class="radio">
        <label>
            <input type="radio" name="{{$name}}" id="{{$label}}1" value="{{$yesValue}}" {{$checked == $yesValue ? 'checked': ''}}> {{$yesText}}
        </label>
    </div>
    <div class="radio">
        <label>
            <input type="radio" name="{{$name}}" id="{{$label}}2" value="{{$noValue}}" {{$checked == $noValue ? 'checked': ''}}> {{$noText}}
        </label>
    </div>
    @error($name)
        <small class="text-danger">
            {{$message}}
        </small>
    @enderror
</div>
