@props(['title' => '', 'proceedText' => 'ok', 'action' => '#', 'image' => '/no-image.jpeg'])
<div class="m-2 card w-96 bg-base-100 shadow-xl border">
    <div class="card-body">
      <h2 class="card-title">{{$title}}</h2>
      <p>{{$slot}}</p>
      <div class="card-actions justify-end">
        <a href="{{$action}}" class="btn btn-primary">{{$proceedText}}</a>
      </div>
    </div>
  </div>
