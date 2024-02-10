<x-layout>
  <x-navbar></x-navbar>
  <x-hero></x-hero>
  @if (request()->has('keyword'))
    <h1 class="text-center font-custom text-2xl mt-4">*** Search Results ***</h1>
  @else 
  <h1 class="text-center font-custom text-2xl mt-4">List of Attractions</h1>
  
  <div class="flex justify-center">
    {{$destinations->links()}}
  </div>
  
  @endif
  <div class="flex px-4 justify-center flex-wrap">
    @forelse ($destinations as $item)         
        <div class="w-full md:w-1/4">
          <x-place-item :photo="count($item->photographs) ? $item->photographs[0]->image: null" :name="$item->name" :id="$item->id"></x-place-item>
        </div>
    @empty 
    <div class="text-2xl text-gray-500 mt-8">
      No Result found.
    </div>
    @endforelse
  </div>
  <div class="flex justify-center">
    {{$destinations->links()}}
  </div>
</x-layout>