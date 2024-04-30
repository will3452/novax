<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    
    <script src='https://api.mapbox.com/mapbox-gl-js/v3.3.0/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v3.3.0/mapbox-gl.css' rel='stylesheet' />
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.3.1/mapbox-gl-directions.js"></script>
<link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.3.1/mapbox-gl-directions.css" type="text/css">
    <style>
        body, html {
            margin: 0px;
            padding: 0px; 
        }
    </style>
</head>
<body>
    <div id='map' style='width: 100vw;height:100vh; '></div>
<script>
    mapboxgl.accessToken = 'pk.eyJ1IjoiZWxlemVya3ciLCJhIjoiY2wxNHE4d2E5MHRvMTNkczA1anltY3lybSJ9.T2bcLRSnEZB_LNGM7Qs5Mw';
    navigator.geolocation.getCurrentPosition((pos) => {
        let { longitude, latitude} = pos.coords; 
        const map = new mapboxgl.Map({
            container: 'map', // container ID
            style: 'mapbox://styles/mapbox/streets-v12', // style URL
            center: [longitude, latitude], // starting position [lng, lat]
            zoom: 9, // starting zoom
        });

        // Create a new marker.
        // const marker = new mapboxgl.Marker()
        //     .setLngLat([longitude, latitude])
        //     .addTo(map);

        let md = new MapboxDirections({ accessToken: mapboxgl.accessToken });
        map.on('load', () => {
            md.setOrigin([longitude, latitude])
            md.setDestination([{{request()->lng}}, {{request()->lat}}])
        })
                
        map.addControl(md, 'top-left');
    })
    </script>
</body>
</html>