@props(['room'])
@if ($room->reviews()->count() != 0)
<div class="pro-details-rating-wrap">
    <div class="pro-details-rating">
        @for ($i = 0; $i < $room->reviews()->avg('star'); $i++)
            <i class="fa fa-star yellow"></i>
        @endfor
    </div>
    <span><a href="#">{{$room->reviews()->count()}} Reviews</a></span>
</div>
@else
<span>No Reviews</span>
@endif
