<x-layout>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
  integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
  crossorigin=""/>
  <x-navbar></x-navbar>
  <div class="w-full md:w-5/6 mx-auto px-2">
    <div>
      <a href="{{url()->previous()}}" class="text-2xl mb-4 block font-custom underline">Back</a>
    </div>
    <x-place-details :attraction="$attraction"></x-place-details>
    <h1 class="mb-4 text-2xl font-custom">Location</h1>
    <div id="map" class="h-60"></div>
    <h1 class="mb-4 text-2xl font-custom my-2 mt-4">Feedback</h1>
    <div class="flex flex-wrap">
      <div class=" w-full md:w-2/3">
      
        @if (count($attraction->feedback))
        <div class="fb-slider owl-carousel owl-theme">
          @foreach ($attraction->feedback as $item)
              <x-feedback-item :feedback="$item"></x-feedback-item>      
          @endforeach 
        </div>
        @else 
        <div class="text-2xl text-gray-300">
          No Feedback Found.
        </div>
        @endif
      </div>
      <div class="w-full md:w-1/3 p-4 " data-aos="fade-left">
        <div class="shadow-lg p-4 rounded-md">
          <h1 class="font-custom font-mono text-xl font-bold">Submit Your Feedback here!</h1>
          <form action="/feedback" method="post" class="w-full" >
            @csrf 
            <input type="hidden" name="destination_id" value="{{$attraction->id}}">
              <div class="text-xl font-custom tracking-widest">
                Full Name
              </div>
              <input required name="name" class="p-2 border-b-2 block w-full mb-4" type="text">
              <div class="text-xl font-custom tracking-widest">
                Profession
              </div>
              <input required name="profession" class="p-2 border-b-2 block w-full mb-4" type="text">
              <div class="text-xl font-custom tracking-widest">
                Message
              </div>
              <textarea name="feedback" required id="" class="block border-b-2 w-full"></textarea>
              <div class="text-xl font-custom tracking-widest mt-4">
                <button class="bg-green-700 text-white rounded-md p-2" type="submit">Send Feedback</button>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Make sure you put this AFTER Leaflet's CSS -->
 <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
 integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
 crossorigin=""></script>

 <script>
  
  let center = [{{$attraction->lat}}, {{$attraction->lng}}]; 
  var map = L.map('map').setView(center, 13);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
  }).addTo(map);

  var destination = L.marker(center).addTo(map);



  navigator.geolocation.getCurrentPosition(position => {
    const { latitude, longitude } = position.coords;
    // Show a map centered at latitude / longitude.
      var userIcon = L.icon({
        iconUrl: '/user.png',

        iconSize:     [38, 38], // size of the icon
    });

    L.marker([latitude, longitude], {icon: userIcon}).addTo(map);
  });
 </script>

 <script>
  $('.fb-slider').owlCarousel({
    loop: true, 
    margin: 10, 
    // center: true, 
    autoHeight:true,
    autoplay: true, 
    autoplayTimeout:3000, 
    autoplayHoverPause:true,
    responsive: {
      0: {
        nav: false, 
        items: 1, 
      },
      900: {
        nav: true, 
        items: 2, 
      }
    }
  })
 </script>
</x-layout>

