<x-layout>
    <x-covid-header></x-covid-header>
    <h1 class="text-center text-xl p-2 font-bold underline">
        {{$covidInfo->title}}
    </h1>
    <div class="px-3 text-justify font-serif">
        {!!\Str::of($covidInfo->body)->markdown()!!}
    </div>
</x-layout>
