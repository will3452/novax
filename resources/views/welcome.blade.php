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

    <x-section>
        <span id="features"></span>
        <x-section-title>
            Features
        </x-section-title>
        <x-section-body>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quam debitis possimus voluptates facere enim consequatur repellendus tenetur magnam ipsum ex, praesentium eveniet aut quo dolore placeat? Cumque commodi quas accusantium voluptas pariatur sapiente, officia illo porro sint distinctio veritatis nisi neque incidunt quos, exercitationem fugit corrupti ab. Similique, numquam!
        </x-section-body>
    </x-section>

    <x-section>
        <span id="contacts"></span>
        <x-section-title>
            Contacts
        </x-section-title>
        <x-section-body>
            user@sample.com | 09096524461 | facebook.com | youtube.com
        </x-section-body>
    </x-section>
</x-layout>
