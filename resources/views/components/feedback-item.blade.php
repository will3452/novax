@props(['feedback'])
<div class="item">
  <div class="flex">
      <div class="w-16">
        <img src="https://ui-avatars.com/api/?name={{$feedback->name}}" class="block w-16 h-16 rounded-full" alt="">
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