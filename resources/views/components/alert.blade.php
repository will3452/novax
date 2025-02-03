<div class="container">
    @foreach ($errors->all() as $item)
        <span class="badge bg-warning" style="font-size:12px;">
            {{$item}}
        </span>
    @endforeach
</div>
