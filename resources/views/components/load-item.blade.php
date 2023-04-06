@props(['item', 'hasLink' => false])
<div class="card" >
    <img class="card-img-top" src="{{$item->image ? "/storage//$item->image" : 'https://cdn.pixabay.com/photo/2016/06/13/07/59/pi-1453836_1280.jpg'}}" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">{{$item->subject->name}}</h5>
      <p class="card-text">{{$item->subject->description}}</p>
      @if ($hasLink)
      <a href="{{route('tl.show', ['load' => $item->id])}}" class="btn btn-primary">Manage</a>
      @endif
    </div>
  </div>
