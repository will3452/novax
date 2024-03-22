@foreach ($errors->all() as $item)
    <div class="text-red-800 font-bold">
        {{$item}}
    </div>
@endforeach