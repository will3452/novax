@if (\App\Models\Banner::count())
<div class="carousel w-full">
    @foreach (\App\Models\Banner::get() as $item)
    <div id="slide{{$loop->index + 1}}" class="carousel-item relative w-full">
        <img src="/storage/{{$item->image}}" class="w-full" style="height: 400px !important;object-fit:cover;"/>
        <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
          <a href="#slide{{$loop->count - ($loop->index)}}" class="btn btn-circle">❮</a>
          <a href="#slide{{$loop->index+2}}" class="btn btn-circle">❯</a>
        </div>
      </div>
    @endforeach

  </div>

@endif
