@props(['room'])
<div class="collection-product">
    <div class="collection-img">
        <a href="/rooms/{{$room->id}}"><img style="height:150px;" src="/storage/{{$room->images()->first()->path}}" alt=""></a>
    </div>
    <div class="collection-content text-center">
        <span>{{ $room->name }}</span>
        <h4><a href="#">by {{ $room->owner->name }}</a></h4>
    </div>
</div>
