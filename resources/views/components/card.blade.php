@props(['title' => 'title of the game', 'href'=>'#', 'img' => '', 'proceedText' => 'play game'])
<div class="m-2 card w-96 bg-base-100 card-compact shadow-xl">
    <figure><img src="{{$img}}"/></figure>
    <div class="card-body">
      <h2 class="card-title">{{$title}}</h2>
      <p>{{$slot}}</p>
      <div class="justify-end card-actions">
        <a href="{{$href}}" class="btn btn-primary">{{$proceedText}}</a>
      </div>
    </div>
  </div>
