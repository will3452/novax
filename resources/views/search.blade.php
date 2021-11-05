<x-layout>
    <x-filter></x-filter>
    @if (count($shops))
        <x-shop-card-container>
            @foreach ($shops as $shop)
            <x-shop-card :shop="$shop" location="{{$shop->distance}}"></x-shop-card>
            @endforeach
        </x-shop-card-container>
    @else
    <div class="text-center p-4 bg-blue-200 mx-2 mt-4 font-bold uppercase text-blue-900">
        No Laundry Shop Available :/
    </div>
    @endif
</x-layout>
