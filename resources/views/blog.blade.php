<x-layout>
    <x-navbar></x-navbar>
    <div class="mx-auto" style="max-width: 1440px">
        <img src="/storage/{{$post->cover}}" class="mb-4" alt="">
        <h1 class="text-2xl font-bold uppercase">{{ $post->title }}</h1>
        <h2>By {{$post->user->name}} </h2>
        <div class="mt-4 text-2xl">
            {!!$post->content!!}
        </div>
    </div>
</x-layout>