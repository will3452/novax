<x-layout>
    <x-navbar></x-navbar>
    <div class="mx-auto" style="max-width: 1440px">
        <div class="columns-3 gap-8">
            <img src="/storage/{{$post->cover}}" class="mb-4" alt="">
            <img src="/storage/{{$post->cover_1}}" class="mb-4" alt="">
            <img src="/storage/{{$post->cover_2}}" class="mb-4" alt="">
        </div>
        <div class="text-center">
            <h1 class="text-2xl font-bold uppercase">{{ $post->title }}</h1>
            <h2>By {{$post->user->name}} </h2>
        </div>
        <div class="mt-4 text-2xl px-4 text-center md:text-left">
            {!!$post->content!!}
        </div>
    </div>
</x-layout>