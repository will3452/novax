<x-layout>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
  integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
  crossorigin=""/>
  <x-navbar></x-navbar>
  <div class="w-full w-5/6 mx-auto px-4">
    <div>
      <a href="{{url()->previous()}}" class="text-2xl mb-4 block font-custom underline">Back</a>
    </div>
    <x-place-details :attraction="$attraction"></x-place-details>
    <h1 class="mb-4 text-2xl font-custom">Location</h1>
    <div id="map" class="h-60"></div>
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
</x-layout>

