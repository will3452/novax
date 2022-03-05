@props(['active' => false])
<li class="step @if($active) step-success @endif">
    {{$slot}}
</li>
