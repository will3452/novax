@props(['attraction'])
@if ($attraction && count($attraction->photographs))
<div class="flex flex-wrap" x-data="{activeImage:`{{count($attraction->photographs) ? '/storage/'.$attraction->photographs[0]['image']: '/no-image.png'}}`, description: '{{ $attraction->description }}', viewAll: false, }">
  <div class="w-full md:w-1/3">
    <img :src="activeImage" alt="" class="object-cover w-full h-52 rounded-md">
    <div class="flex relative -top-5 justify-center">
      @foreach ($attraction->photographs as $item)
        @if (!$loop->first || count($attraction->photographs) >= 2)
          <img @click="activeImage = '/storage/{{$item->image}}'" src='/storage/{{$item->image}}' alt="" class=" border-4 border-white transition-all w-12 h-12 rounded-full  hover:sepia cursor-pointer mr-2">
        @endif
      @endforeach
    </div>
  </div>
  <div class="w-full md:w-2/3 px-4">
    <h1 class="text-2xl font-bold font-custom" >{{ $attraction->name }}</h1>
    <p> <span class="font-bold">Description: </span> <span x-html="viewAll ? description: `${description.substr(0, 300)}${description.length > 300 ? '...':''}`"></span> <a href="#" @click.prevent="viewAll = !viewAll" x-text="viewAll ? '[Hide]' : '[Read More]'"></a></p>
    <div class="flex flex-wrap">
      <div class="w-full md:w-1/2">
        <span class="font-bold">Category: </span> {{ $attraction->category->category }}.
      </div>
      <div class="w-full nd:w-1/2">
        <span class="font-bold">Entry Fees: </span> P{{number_format($attraction->entry_fees, 2)}}
      </div>
    </div>
    <div class="flex flex-wrap">
      <div class="w-full: md:w-1/2">
        <span class="font-bold">Operating hours: </span>{{$attraction->operating_hours}}
      </div>
      <div class="w-full md:w-1/2">
        <span class="font-bold">Best time to visit: </span> {{$attraction->best_time_to_visit}}
      </div>
    </div>
    <div class="flex flex-wrap">
      <div class="w-full md:w-1/2">
        <span class="font-bold">Nearby Accomodation: </span> {{implode(', ', $attraction->nearby_accommodations)}}
      </div>
      <div class="w-full md:w-1/2">
        <span class="font-bold">Transportation: </span> {{implode(', ', $attraction->transportation)}}
      </div>
      <div class="w-full md:w-1/2">
        <span class="font-bold">Weather: </span> {{ implode(', ', $attraction->weather)}}
      </div>
    </div>
  </div>
</div>
@endif