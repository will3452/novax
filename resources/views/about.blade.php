<x-layout>
    <x-container>
        <x-header>
            About us
        </x-header>
        <p class="text-center my-5">
            {{nova_get_setting('about', 'please setup to the setting.')}}
        </p>
    </x-container>
</x-layout>
