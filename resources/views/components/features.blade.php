<div class="collections-area  pb-95 mt-4">
    <div class="container">
        <div class="section-title-3 mb-40">
            <h4>Features</h4>
        </div>
        <div class="collection-wrap">
            <div class="collection-active owl-carousel owl-dot-none">
                @foreach (\App\Models\Room::with('images')->inRandomOrder()->take(7)->get() as $item)
                    <x-features-item :room="$item"></x-features-item>
                @endforeach
            </div>
        </div>
    </div>
</div>
