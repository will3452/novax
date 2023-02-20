@props(['room'])
<div class="review-wrapper">
    @forelse ($room->reviews as $review)
    <div class="single-review">
        <div class="review-content">
            <div class="review-top-wrap">
                <div class="review-left">
                    <div class="review-name">
                        <h4>{{$review->user->name}}</h4>
                    </div>
                    <div class="review-rating">
                        @for ($i = 0; $i < $review->star; $i++)
                            <i class="fa fa-star"></i>
                        @endfor
                    </div>
                </div>
            </div>
            <div class="review-bottom">
                <p>{{$review->message}}</p>
            </div>
        </div>
    </div>
    @empty
    <div class="text-center alert alert-secondary">
        No Review
    </div>
    @endforelse
</div>
