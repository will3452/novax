@props(['room'])
<div class="product-wrap-5 mb-25">
    <div class="product-img">
        <a href="">
            <img src="/storage/{{$room->images()->first()->path}}" alt="" style="height:150px;">
        </a>
        <span class="purple">{{ $room->category }}</span>
        <div class="product-action-4">
            <div class="pro-same-action pro-quickview">
                <a title="Book now" href="/booking/{{$room->id}}"data-bs-target="#exampleModal"><i class="pe-7s-ticket"></i></a>
            </div>
            <div class="pro-same-action pro-quickview">
                <a title="Quick View" href="/rooms/{{$room->id}}" data-bs-target="#exampleModal"><i class="pe-7s-look"></i></a>
            </div>
        </div>
    </div>
    <div class="product-content-5 text-center">
        <h3><a href="/rooms/{{$room->id}}">{{ $room->name }}</a></h3>
        <div class="price-5">
            <span>₱ {{number_format($room->monthly, 2)}} / Month</span>
        </div>
    </div>
</div>
