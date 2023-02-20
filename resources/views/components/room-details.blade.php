@props(['room'])
<div class="product-details-content">
    <h2>{{ $room->name }}</h2>
    <div class="product-details-price">
        <span>PHP {{ number_format($room->monthly, 2) }} / monthly</span>
    </div>
    <x-stars :room="$room"></x-stars>
    <p>Description: {{$room->description}}</p>
    <p>Address: {{$room->address}}</p>
    <p>Category: {{$room->category}}</p>
</div>
