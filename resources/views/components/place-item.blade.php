@props(['photo', 'name', 'id'])
<div class="w-full h-64 md:h-80 p-4">
    <a href="/attractions/{{$id}}"  class="block relative shadow-lg rounded-md hover:scale-105 transition" style="z-index:1; background:url('{{$photo ? "/storage/".$photo : '/no-image.png'}}'); background-repeat:no-repeat; background-size:cover; background-position:center; position:relative; height:90%;">
      {{-- <div style="position:absolute; bottom:0px; background:rgba(255, 255, 255, 0.5);" class="p-4 w-full absolute bottom-1  bg-opacity-5 truncate font-custom text-xl tracking-wider bg-white">
        
      </div> --}}
    </a>
    <p style="width:100%; text-align:left; " class="p-2 text-left w-full text-2xl">
      {{ $name }}
    </p>
</div>