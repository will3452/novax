<x-layout>
    <x-navbar></x-navbar>
    <div class="text-center">
      <h1 class="text-4xl font-bold uppercase font-custom">Blogs</h1>
     <div class="flex flex-wrap">
        @foreach ($posts as $item)
            <x-blog-item :blog="$item"></x-blog-item>
        @endforeach
     </div>
    </div>
  </x-layout>