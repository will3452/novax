@props(['item'])
<div class="shadow-md my-2 mb-4 ">
    <div class="bg-gray-300 p-4 font-bold flex justify-between">
        <div class="flex gap-2">
            <div class="title truncate max-w-[300px]">{{ $item->title }}</div>
            <small class="text-xs font-thin created_at">{{$item->created_at->format('M d, Y')}}</small>
        </div>
        <span class="material-symbols-outlined rotate-45">
        push_pin
        </span>
    </div>
    <div class="flex p-4 justify-between">
        <a href="{{route('news.show', ['post' => $item->id])}}"
            class="w-full text-center p-2 rounded border bg-blue-900 text-white">Read more</a>
            {{-- <a href="{{route('news.show', ['post' => $item->id])}}#disqus_thread"
                class="text-sm text-blue-500 font-bold underline block">Comments</a> --}}
    </div>
</div>