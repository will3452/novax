<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<link href="https://api.mapbox.com/mapbox-gl-js/v3.2.0/mapbox-gl.css" rel="stylesheet">
  <script src="https://api.mapbox.com/mapbox-gl-js/v3.2.0/mapbox-gl.js"></script>
  <style>
    body { margin: 0; padding: 0; }
    /* #map { position: absolute; top: 0; bottom: 0; width: 100%; } */
  </style>
  <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.2.0/mapbox-gl-directions.js"></script>
  <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.2.0/mapbox-gl-directions.css" type="text/css">
  
  <div id="map" class="h-80"></div>

  <script>

  navigator.geolocation.getCurrentPosition(position => {
      const { latitude, longitude } = position.coords;
      // Show a map centered at latitude / longitude.
      mapboxgl.accessToken = 'pk.eyJ1IjoiZWxlemVya3ciLCJhIjoiY2wxNHE4d2E5MHRvMTNkczA1anltY3lybSJ9.T2bcLRSnEZB_LNGM7Qs5Mw';
      const map = new mapboxgl.Map({
          container: 'map',
          // Choose from Mapbox's core styles, or make your own style with Mapbox Studio
          style: 'mapbox://styles/mapbox/streets-v12',
          center: [longitude, latitude],
          zoom: 13,
      });
      let direction = new MapboxDirections({
              accessToken: mapboxgl.accessToken,
          });
      map.addControl(
        direction, 
          'top-right'
      );

      map.on('load', () => {
        direction.setOrigin([longitude, latitude])
        direction.setDestination([{{$attraction->lng}}, {{$attraction->lat}}])
      })
    });
    
  </script>
  {{-- <!-- Make sure you put this AFTER Leaflet's CSS -->
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
</body>
</html>