<x-layout>
  <x-navbar></x-navbar>
  <x-hero></x-hero>
  @if (request()->has('keyword'))
    <h1 class="text-center font-custom text-2xl mt-4">*** Search Results ***</h1>
  @else 
  <h1 class="text-center font-custom text-2xl mt-4">List of Attractions</h1>
  @endif
  <div class="flex px-4 justify-center">
    @forelse ($destinations as $item)         
        <div class="w-full md:w-1/4">
          <x-place-item :photo="$item->photographs[0]->image" :name="$item->name" :id="$item->id"></x-place-item>
        </div>
    @empty 
    <div class="text-2xl text-gray-500 mt-8">
      No Result found.
    </div>
    @endforelse
  </div>
</x-layout>