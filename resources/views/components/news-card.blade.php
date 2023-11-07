@props(['item'])
<div class="border-2 border-gray-500 my-2 mb-4  bg-gray-300">
    <div class="bg-gray-300 p-4 font-bold flex justify-between">
        
        <span class="title">{{ $item->title }} <small class="text-xs font-thin created_at">{{$item->created_at->format('M d, Y')}}</small></span>
        <span class="material-symbols-outlined rotate-45">
            push_pin
            </span>
    </div>
    <div class=" p-4 body">
        {{ \Str::limit($item->body, 100) }}
    </div>
    <div class="flex p-4 justify-between">
        <a href="{{route('news.show', ['post' => $item->id])}}"
            class="text-sm font-bold underline block">Read more</a>
            {{-- <a href="{{route('news.show', ['post' => $item->id])}}#disqus_thread"
                class="text-sm text-red-500 font-bold underline block">Comments</a> --}}
    </div>
</div>