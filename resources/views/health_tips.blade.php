<x-layout>
    @push('head')
        <script src="//unpkg.com/alpinejs" defer></script>
    @endpush
    <div class="w-11/12 mx-auto my-4">
        <h1 class="text-center text-2xl uppercase mb-4">
            Tips
        </h1>
        @if (request()->has('alert'))
            <x-alert-success>
                {{request()->alert}}
            </x-alert-success>
        @endif
        <div class="h-screen overflow-y-auto">
            <div class="flex justify-center">
                <div class="w-full md:w-1/2 p-4 rounded bg-white">
                    <h1 class="text-center text-2xl">
                        {{$tip->title}}
                    </h1>
                    <div class="content">
                        {!!$tip->content!!}
                    </div>
                    <div class="text-center">
                        <a href="/tips?old={{$tip->id}}" class="btn btn-primary">

<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-refresh-ccw"><polyline points="1 4 1 10 7 10"></polyline><polyline points="23 20 23 14 17 14"></polyline><path d="M20.49 9A9 9 0 0 0 5.64 5.64L1 10m22 4l-4.64 4.36A9 9 0 0 1 3.51 15"></path></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
</x-layout>
