
@props(['rooms' => \App\Models\Room::latest()->get()])
<div class="product-area pb-70">
    <div class="container">
        <div class="tab-content jump">
            <div class="tab-pane active" id="product-1">
                <div class="row">
                    @forelse ($rooms as $item)
                        <div class="col-xl-3 col-md-6 col-lg-4 col-sm-6">
                            <x-item :room="$item"></x-item>
                        </div>
                    @empty
                    <div class="alert alert-secondary text-center">
                        No found
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
