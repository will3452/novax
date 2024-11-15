@props(['filled' => false])
<div class="w-[30px] h-[30px] border border-gray-900 relative flex items-center justify-center overflow-hidden">
    <div class="h-[15px] w-[15px] border-2 border-gray-900 rounded-full {{$filled ? 'bg-gray-600' : 'bg-white'}} z-20"></div>
    <div class="w-[30px] h-[30px] rotate-45 border-2 border-gray-900 absolute -top-[15px]"></div>
    <div class="w-[30px] h-[30px] rotate-45 border-2 border-gray-900 absolute top-[15px]"></div>
</div>
