@props(['photo', 'name', 'id'])
<div class="w-full h-52 md:h-80 p-4">
    <a href="/attractions/{{$id}}" class="block relative shadow-lg rounded-md  h-full hover:scale-105 transition" style="z-index:1; background:url('/storage/{{$photo}}'); background-repeat:no-repeat; background-size:cover; background-position:center; position:relative; ">
      <div style="position:absolute; bottom:0px; background:rgba(255, 255, 255, 0.5);" class="p-4 w-full absolute bottom-1  bg-opacity-5 truncate font-custom text-xl tracking-wider bg-white">
        {{ $name }}
      </div>
  </a>
</div>