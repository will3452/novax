<x-layout>

    <script src='https://api.mapbox.com/mapbox-gl-js/v3.2.0/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v3.2.0/mapbox-gl.css' rel='stylesheet' />
    <div class="mx-auto max-w-[900px]">
        <div class="text-3xl mt-4 font-bold text-center ">
            BOOKING DETAILS
        </div>
        <div class="flex items-center">
            <div class="w-1/4 text-center">Passenger</div>
            <div class="w-2/4 border border-dashed border-gray-400"></div>
            <div class="w-1/4 text-center">{{$booking->passenger->name}}</div>
        </div>
        <div class="flex items-center">
            <div class="w-1/4 text-center">Payable</div>
            <div class="w-2/4 border border-dashed border-gray-400"></div>
            <div class="w-1/4 text-center">PHP {{$booking->payable}}</div>
        </div>
        <div class="flex items-center">
            <div class="w-1/4 text-center">Driver</div>
            <div class="w-2/4 border border-dashed border-gray-400"></div>
            <div class="w-1/4 text-center">{{$booking->driver->name}}</div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
            <div>
                <div class="font-bold py-2 uppercase text-center">Pick Up Location</div>
                <div id='map-pu' class="w-full h-[300px]"></div>
            </div>
            
            <div>
                <div class="font-bold py-2 uppercase text-center">Destination</div>
                <div id='map-des' class="w-full h-[300px]"></div>
            </div>
        </div>
    </div>
    <script>
    mapboxgl.accessToken = 'pk.eyJ1IjoiZWxlemVya3ciLCJhIjoiY2wxNHE4d2E5MHRvMTNkczA1anltY3lybSJ9.T2bcLRSnEZB_LNGM7Qs5Mw';
    const map = new mapboxgl.Map({
        container: 'map-pu', // container ID
        style: 'mapbox://styles/mapbox/streets-v12', // style URL
        center: @json($booking->from_coords).split(','), // starting position [lng, lat]
        zoom: 12, // starting zoom
    });

    const des = new mapboxgl.Map({
        container: 'map-des', // container ID
        style: 'mapbox://styles/mapbox/streets-v12', // style URL
        center: @json($booking->to_coords).split(','), // starting position [lng, lat]
        zoom: 12, // starting zoom
    });

    var pickUpLocation = []; 
    var destination = []; 

    let marker = null; 

    let desMarker = null;

    let geolocate = new mapboxgl.GeolocateControl({
        positionOptions: {
            enableHighAccuracy: true
        },
        trackUserLocation: true,
        showUserHeading: true
    }); 

    let desGeolocate = new mapboxgl.GeolocateControl({
        positionOptions: {
            enableHighAccuracy: true
        },
        trackUserLocation: true,
        showUserHeading: true
    }); 

    map.addControl(geolocate)
    des.addControl(desGeolocate)

    new mapboxgl.Marker({
                color: '#1e40af',
            })
            .setLngLat(@json($booking->from_coords).split(','))
            .addTo(map);

    new mapboxgl.Marker({
                color: 'red', 
            })
            .setLngLat(@json($booking->to_coords).split(','))
            .addTo(des);
    </script>
</x-layout>