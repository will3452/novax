@props(['label' => '', 'name' => '', 'value' => '', 'optionValue' => [], 'optionLabel' => [], 'required' => false])
<div class="form-group">
    <label>{{$label}} <span class="text-danger">{{ $required ? '*' : ''}}</span></label>
    <select class="form-control" name="{{$name}}" value="{{$value ?? old($name)}}" {{$required ? 'required' : ''}}>
        <option value="" selected>-</option>
        @foreach ($optionValue as $option)
            <option value="{{$option}}" {{ $value == $option ? 'selected': '' }}>
                {{$optionLabel[$loop->index]}}
            </option>
        @endforeach
    </select>
</div>
