@props(['title'=>'---'])
<li x-data="{isOpen:false}" class="border-t-2 py-4">
    <div class="flex items-center justify-between">
        <span class="text-base font-bold uppercase text-gray-800">
            {{$title}}
        </span>
        <button class="btn btn-sm" x-on:click="isOpen = !isOpen" x-text="isOpen ? 'show less': 'show more'">
        </button>
    </div>
    <div x-show="isOpen">
        {{$slot}}
    </div>
</li>
