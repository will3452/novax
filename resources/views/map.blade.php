<x-layout>
  <x-navbar></x-navbar>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
  integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
  crossorigin=""/>
  <div class="text-center">
    <h1 class="text-4xl font-bold uppercase font-custom">MAP</h1>
    <div>
      <div id="map" class="h-screen"></div>
    </div>
  </div>
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
  integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
  crossorigin=""></script>
  <script>
    var map = L.map('map')
      L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
  
    // var destination = L.marker(center).addTo(map);
  
    var destinations = @json($destinations)

    destinations.forEach(d => {
      let image = '/no-image.png'
      let pop = L.popup()
        .setContent(`
        <img class="w-32 h-16 mb-2 mx-auto block" style="object-fit:cover; " src="${image}"/>
        <div class="text-center" >${d.name} <a href="/attractions/${d.id}">show more.</a><div>
        `)
      L.marker([d.lat, d.lng])
        .bindPopup(pop)
        .openPopup()
        .addTo(map)
    });
  
  
    navigator.geolocation.getCurrentPosition(position => {
      const { latitude, longitude } = position.coords;
      // Show a map centered at latitude / longitude.
        var userIcon = L.icon({
          iconUrl: '/user.png',
  
          iconSize:     [38, 38], // size of the icon
      });
  
      map.setView([latitude, longitude], 13);
      L.marker([latitude, longitude], {icon: userIcon}).addTo(map);
    });
   </script>
</x-layout>