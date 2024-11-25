@props(['route', 'image'])
<a href="{{$route}}" class="flex flex-col items-center gap-2 p-2">
    <img src="/images/{{$image}}" alt="" class="w-2/3 object-fit">
    <div class="text-xs font-bold">{{$slot}}</div>
</a>
