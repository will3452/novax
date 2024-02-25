@props(['feedback'])
<div class="item border-2 p-2">
  <div class="flex">
      <div class="w-16">
        <img src="https://ui-avatars.com/api/?name={{$feedback->name}}" class="block w-8 h-8 rounded-full" alt="">
      </div>
      <div class="mx-2">
        <h1 class="text-2xl font-custom">{{$feedback->name}}</h1>
        <h2 class="text-md font-custom text-gray-500">{{$feedback->profession}}</h2>
      </div>
  </div>
  <div>
    {{$feedback->feedback}}
  </div>
</div>