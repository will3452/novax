<div class="flex flex-wrap">
    <div class="w-full md:w-1/3">
      <img :src="activeImage" alt="" class="object-cover w-full h-52 rounded-md">
      <div class="flex relative -top-5 justify-center">
        <img @click="activeImage = 'https://picsum.photos/seed/1/200/200'" src="https://picsum.photos/seed/1/200/200" alt="" class=" border-4 border-white transition-all w-12 h-12 rounded-full  hover:sepia cursor-pointer mr-2">
        <img @click="activeImage = 'https://picsum.photos/seed/2/200/200'" src="https://picsum.photos/seed/2/200/200" alt="" class=" border-4 border-white transition-all w-12 h-12 rounded-full  hover:sepia cursor-pointer mr-2">
        <img @click="activeImage = 'https://picsum.photos/seed/3/200/200'" src="https://picsum.photos/seed/3/200/200" alt="" class=" border-4 border-white transition-all w-12 h-12 rounded-full  hover:sepia cursor-pointer mr-2">
      </div>
    </div>
    <div class="w-full md:w-2/3 px-4">
      <h1 class="text-2xl font-bold font-custom" >Lorem ipsum dolor sit amet.</h1>
      <p> <span class="font-bold">Description: </span> <span x-text="viewAll ? description: `${description.substr(0, 300)}${description.length > 300 ? '...':''}`"></span> <a href="#" @click.prevent="viewAll = !viewAll" x-text="viewAll ? '[Hide]' : '[Read More]'"></a></p>
      <div class="flex flex-wrap">
        <div class="w-full md:w-1/2">
          <span class="font-bold">Category: </span> Lorem.
        </div>
        <div class="w-full nd:w-1/2">
          <span class="font-bold">Entry Fees: </span> P100.00
        </div>
      </div>
      <div class="flex flex-wrap">
        <div class="w-full: md:w-1/2">
          <span class="font-bold">Operating hours: </span> 9:00 am - 5:00 pm every weekdays
        </div>
        <div class="w-full md:w-1/2">
          <span class="font-bold">Best time to visit: </span> Tuesday
        </div>
      </div>
      <div class="flex flex-wrap">
        <div class="w-full md:w-1/2">
          <span class="font-bold">Nearby Accomodation: </span> Hotel, Motel
        </div>
        <div class="w-full md:w-1/2">
          <span class="font-bold">Transportation: </span> Train, Car
        </div>
        <div class="w-full md:w-1/2">
          <span class="font-bold">Weather: </span> Rainy
        </div>
      </div>
    </div>
  </div>