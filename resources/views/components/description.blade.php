@props(['label' => '', 'value' => ''])
<div style="margin-bottom: 0.5em">
    {{$label}}: <b>{{$value == '' ? '--': $value}}</b> {{$slot}}
</div>
