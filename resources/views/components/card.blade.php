@props(['title' => '', 'proceedText' => 'ok', 'action' => '#', 'image' => '/no-image.jpeg'])
<div class="card card-compact w-80 bg-base-100 shadow-xl m-4 border">
    <figure><img src="{{$image}}" alt="card image"></figure>
    <div class="card-body">
      <h2 class="card-title">{{$title}}</h2>
      <p>{{$slot}}</p>
      <div class="card-actions justify-end">
        <a href="{{$action}}" class="btn btn-primary">{{$proceedText}}</a>
      </div>
    </div>
  </div>
