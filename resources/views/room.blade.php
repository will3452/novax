<x-layout>
    <x-header></x-header>
<div class="shop-area pt-100 pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product-details">
                    <div class="product-details-img">
                        <div class="tab-content jump">
                            <div id="shop-details-1" class="tab-pane large-img-style">
                                <img src="/storage/{{$room->images()->first()->path}}" alt="">
                                <div class="img-popup-wrap">
                                    <a class="img-popup" href="/storage/{{$room->images()->first()->path}}"><i class="pe-7s-expand1"></i></a>
                                </div>
                            </div>
                            <div id="shop-details-2" class="tab-pane active large-img-style">
                                <img src="/storage/{{$room->images[1]->path}}" alt="">
                                <div class="img-popup-wrap">
                                    <a class="img-popup" href="/storage/{{$room->images[1]->path}}"><i class="pe-7s-expand1"></i></a>
                                </div>
                            </div>
                            <div id="shop-details-3" class="tab-pane large-img-style">
                                <img src="/storage/{{$room->images[2]->path}}" alt="">
                                <div class="img-popup-wrap">
                                    <a class="img-popup" href="/storage/{{$room->images[2]->path}}"><i class="pe-7s-expand1"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="shop-details-tab nav">
                            <a class="shop-details-overly" href="#shop-details-1" data-bs-toggle="tab">
                                <img height="100" src="/storage/{{$room->images[0]->path}}" alt="">
                            </a>
                            <a class="shop-details-overly active" href="#shop-details-2" data-bs-toggle="tab">
                                <img height="100" src="/storage/{{$room->images[1]->path}}" alt="">
                            </a>
                            <a class="shop-details-overly" href="#shop-details-3" data-bs-toggle="tab">
                                <img height="100" src="/storage/{{$room->images[2]->path}}" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <x-room-details :room="$room"></x-room-details>
                <div class="product-details-content">
                    <div class="pro-details-quality">
                        <div class="pro-details-cart btn-hover">
                            <a href="/booking/{{$room->id}}">BOOK NOW</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="description-review-area pb-90">
    <div class="container">
        <div class="description-review-wrapper">
            <div class="description-review-topbar nav">
                <a data-bs-toggle="tab" href="#des-details3">Reviews</a>
            </div>
            <div class="tab-content description-review-bottom">
                <div id="des-details3" class="tab-pane active">
                    <div class="row">
                        <div class="col-lg-7">
                            <x-reviews :room="$room"></x-reviews>
                        </div>
                       @auth
                       <div class="col-lg-5">
                        <div class="ratting-form-wrapper pl-50">
                            <h3>Add a Review</h3>
                            <div class="ratting-form">
                                <form action="/review/{{$room->id}}" method="POST">
                                    @csrf
                                    <label for="">Choose Star</label>
                                    <select name="star" id="" class="form-select">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                    <div class="row">
                                        <div class="col-md-12 mt-2">
                                            <div class="rating-form-style form-submit">
                                                <textarea placeholder="Message" name="message"></textarea>
                                                <input type="submit" value="Submit">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                       @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</x-layout>
