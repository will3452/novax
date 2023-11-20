<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Leaflet Routing Machine Example</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />
    <link rel="stylesheet" href="/leaflet-routing-machine.css" />
    <meta http-equiv="refresh" content="30" >
    <style>
        .map {
            position: absolute;
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>
    <div id="map" class="map"></div>

    <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
    <script src="/leaflet-routing-machine.js"></script>
    <script>
        var map = L.map('map');

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        function load() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(init);
                }

                function init (position) {

                    L.Routing.control({
                        waypoints: [
                            L.latLng(position.coords.latitude, position.coords.longitude),
                            L.latLng({{$user->lat ?? 0}} , {{$user->lng ?? 0}})
                        ],
                        routeWhileDragging: true
                    }).addTo(map);
                }
        }


        load();

    </script>
</body>
</html>