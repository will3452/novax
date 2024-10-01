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
    /* .mapboxgl-ctrl-directions {
      display: none; 
    } */
  </style>
  <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.2.0/mapbox-gl-directions.js"></script>
  <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.2.0/mapbox-gl-directions.css" type="text/css">
  
  <div id="map" class="h-screen"></div>

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
          direction.setDestination([longitude, latitude])
        })
      });
      
    </script>
  
</body>
</html>