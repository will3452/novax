<x-layout>

    <x-navbar></x-navbar>

    <x-carousel-container>
        <x-carousel-item id="item1">
            <img src="https://picsum.photos/id/500/800/300" class="w-full">
        </x-carousel-item>
        <x-carousel-item id="item2">
            <img src="https://picsum.photos/id/501/800/300" class="w-full">
        </x-carousel-item>
        <x-carousel-item id="item3">
            <img src="https://picsum.photos/id/502/800/300" class="w-full">
        </x-carousel-item>
        <x-carousel-item id="item4">
            <img src="https://picsum.photos/id/503/800/300" class="w-full">
        </x-carousel-item>
    </x-carousel-container>

    <x-carousel-trigger-container>
        <x-carousel-trigger-item target="item1">
            1
        </x-carousel-trigger-item>
        <x-carousel-trigger-item target="item2">
            2
        </x-carousel-trigger-item>
        <x-carousel-trigger-item target="item3">
            3
        </x-carousel-trigger-item>
        <x-carousel-trigger-item target="item4">
            4
        </x-carousel-trigger-item>
    </x-carousel-trigger-container>



    <x-container>
        <div class="md:w-2/3">
            <x-section>
                <span id="features"></span>
                <x-section-title>
                    Features
                </x-section-title>
                <x-section-body>
                    {{ nova_get_setting('features') }}
                </x-section-body>
            </x-section>
            <x-section>
                <span id="contacts"></span>
                <x-section-title>
                    Contacts
                </x-section-title>
                <x-section-body>
                   @foreach (\App\Helpers\Contact::parse(nova_get_setting('contacts')) as $item)
                    {{$item}}
                    @if (! $loop->last)
                        |
                    @endif
                   @endforeach
                </x-section-body>
            </x-section>
        </div>
        <div class="shadow border shadow p-4 md:w-1/3 mx-4">
            <h2 class="text-xl font-bold tracking-widest text-gray-700 mb-8">
                Announcement
            </h2>
            <x-announcement>
                @foreach (\App\Models\Announcement::latest()->take(5)->get() as $item)
                <x-announcement-item :title="$item->title">
                    {{ $item->body }}
                </x-announcement-item>
                @endforeach
            </x-announcement>

            <div class="bg-gray-200 p-4">
                <a href="/register" class="btn btn-sm btn-primary">Register now</a>
                <a href="/admin/login" class="btn btn-sm">Login</a>
            </div>

        </div>
    </x-container>
</x-layout>
