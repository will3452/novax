<x-layout>
    <div class="w-11/12 mx-auto my-4 h-screen overflow-y-scroll">
        <h1 class="text-center text-2xl uppercase mb-4">
            Dashboard
        </h1>
        @if (request()->has('alert'))
            <x-alert-success>
                {{request()->alert}}
            </x-alert-success>
        @endif
        <div class="overflow-x-auto flex md:justify-center">
            <x-stats></x-stats>
        </div>
        <div class="mt-4">
            <x-app-list></x-app-list>
        </div>
    </div>
</x-layout>
