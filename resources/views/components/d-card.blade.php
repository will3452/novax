@props(['href' => '#'])
<a href="{{$href}}" class="col-md-3 col-6 my-2 dashboard-link">
    <div class="dashboard-card">
        {{$slot}}
    </div>
</a>
