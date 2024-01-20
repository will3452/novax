<x-layout>
  <x-navbar></x-navbar>
  <x-hero></x-hero>
  <div class="p-2 mt-2 mx-auto md:w-4/5">
    <h1 class="sticky top-0 text-4xl font-custom hover:underline text-center bg-white p-4"> Attractions</h1>
    <div class="flex mt-2 text-center flex-wrap ">
      <x-place-item></x-place-item>
      <x-place-item></x-place-item>
      <x-place-item></x-place-item>
      <x-place-item></x-place-item>
      <x-place-item></x-place-item>
      <x-place-view-more></x-place-view-more>
    </div>
    <h1 class="sticky top-0 z-1 text-4xl font-custom hover:underline text-center bg-white p-4 mt-4"> Blogs</h1>
    <div class="flex flex-wrap">
      <x-blog-item></x-blog-item>
      <x-blog-item></x-blog-item>
      <x-blog-item></x-blog-item>
      <x-blog-item></x-blog-item>
      <x-blog-item></x-blog-item>
      <x-blog-item></x-blog-item>
      <x-blog-item></x-blog-item>
      <x-blog-item></x-blog-item>
      <x-blog-item></x-blog-item>
      <x-blog-view-more></x-blog-view-more>
    </div>
  </div>
</x-layout>