<x-layout>
    <x-navbar></x-navbar>
    <x-sub-navbar></x-sub-navbar>
    @if (! request()->has('search'))
        <x-carousel></x-carousel>
    @endif

    <div class="flex">
        <div class=" bg-secondary w-3/12 ">
            <div class=" sticky top-0">
                <h3 class="m-4 text-2xl text-white font-serif text-center">
                    Category
                </h3>
                <ul class=" m-4 menu bg-base-100 rounded shadow">
                    <li  class="{{request()->category == 'Latest products' ? 'bordered': ''}}">
                        <a href="/?category=Latest+products">New Products</a>
                    </li>
                    @foreach (\App\Models\Category::get() as $item)
                    <li class="{{request()->category == $item->name ? 'bordered': ''}}">
                        <a href="/?category={{$item->name}}">{{$item->name}}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="w-8/12">
            @if (request()->has('search'))
                <h1 class="font-serif text-4xl mx-4 my-4 underline underline-offset-4 text-secondary">Keyword: " <span class="italic">{{request()->search}}</span> "</h1>
            @else
                <h1 class="font-serif text-4xl mx-4 my-4 underline underline-offset-4 text-secondary">{{request()->has('category') ? request()->category: 'Latest Products'}}</h1>
            @endif
            <div class="flex justify-start flex-wrap">
                @forelse ($products as $item)
                    <x-product :product="$item"></x-product>
                @empty
                    <div class="bg-warning m-4 p-4">
                        No Product found.
                    </div>
                @endforelse
            </div>
            <div class="p-2">
                {{$products->links()}}
            </div>
        </div>
    </div>
</x-layout>
