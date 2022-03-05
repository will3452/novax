@props(['active'=>false])

<div class="mb-4 relative h-auto">
    @if(!$active)
        <div class="border-2 border-dashed w-full h-full absolute p-2 flex justify-center items-center p-4 bg-white">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
        </div>
    @endif
    <div class="text-left  ">
        {{$slot}}
    </div>
</div>
