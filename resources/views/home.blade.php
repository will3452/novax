<x-layout>
    <x-header></x-header>
    <div class="container">

        @if (! auth()->user()->dorm)
            <div class="text-center">
                <a href="/" class="btn btn-lg uppercase btn-primary" >Find a dorm?</a>
            </div>
        @else

       <div class="card">
        <div class="card-header">
            Your Dorm
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product-details">
                        <div class="product-details-img">
                            <div class="tab-content jump">
                                <div id="shop-details-1" class="tab-pane large-img-style">
                                    <img src="/storage/{{auth()->user()->dorm->images()->first()->path}}" alt="">
                                    <div class="img-popup-wrap">
                                        <a class="img-popup" href="/storage/{{auth()->user()->dorm->images()->first()->path}}"><i class="pe-7s-expand1"></i></a>
                                    </div>
                                </div>
                                <div id="shop-details-2" class="tab-pane active large-img-style">
                                    <img src="/storage/{{auth()->user()->dorm->images[1]->path}}" alt="">
                                    <div class="img-popup-wrap">
                                        <a class="img-popup" href="/storage/{{auth()->user()->dorm->images[1]->path}}"><i class="pe-7s-expand1"></i></a>
                                    </div>
                                </div>
                                <div id="shop-details-3" class="tab-pane large-img-style">
                                    <img src="/storage/{{auth()->user()->dorm->images[2]->path}}" alt="">
                                    <div class="img-popup-wrap">
                                        <a class="img-popup" href="/storage/{{auth()->user()->dorm->images[2]->path}}"><i class="pe-7s-expand1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <x-room-details :room="auth()->user()->dorm"></x-room-details>
                    <div class="product-details-content">
                        <div class="pro-details-quality">
                            <div class="pro-details-cart btn-hover">
                                <a href="/transactions">VIEW BILLINGS</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       </div>
        @endif

    </div>
</x-layout>
