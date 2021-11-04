<x-layout>
    <x-searchbar></x-searchbar>
    <x-shop-card-container>
        @foreach ($shops as $shop)
        <x-shop-card :shop="$shop" location="100"></x-shop-card>
        @endforeach
    </x-shop-card-container>
</x-layout>
