<div  class="backdrop-opacity-50 bg-black/30 p-4 w-full md:w-1/3 mx-auto" x-data="{}">
    <div class="text-white text-center">
        <div class="text-xs font-thin md:text-lg">
            {{now()->toFormattedDateString()}}
        </div>
        <div class="text-4xl md:text-6xl font-bold tracking-widest"  wire:poll.1000ms>
            {{now()->toTimeString()}}
        </div>
        <div class="text-sm uppercase" @click="alert('Underdevelopment')">
            Philippines
        </div>
    </div>
</div>