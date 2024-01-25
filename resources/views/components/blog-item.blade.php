@props(['blog'])
<div class=" w-full md:w-1/2 h-auto md:h-64 p-2" data-aos="fade-right">
    <div class="flex items-center border border-gray-50 rounded-md shadow-lg overflow-hidden h-full">
        <img src="/storage/{{$blog->cover}}" alt="" class="h-full w-1/3">
        <div class="h-full p-4 w-2/3  bg-gray-50">
        <h2 class="font-custom text-2xl">{{$blog->title}}</h2>
        <h4 class="md:text-xl">By {{$blog->user->name}}</h4>
        <h3 class="font-thin md:text-xl">{{$blog->excerpt}}</h3>
        <a href="/blog/{{$blog->id}}" class="mt-2 underline md:text-xl md:font-bold">Read more</a>
        </div>
    </div>
  </div>