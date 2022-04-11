<x-layout>
    <div>
        <h1 class="text-center text-2xl">
            About
        </h1>
        <p>
            {!!\Str::markdown(nova_get_setting('about', 'set to admin setting please'))!!}
        </p>
    </div>
</x-layout>
