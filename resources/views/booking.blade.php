<x-layout>

    <script src='https://api.mapbox.com/mapbox-gl-js/v3.2.0/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v3.2.0/mapbox-gl.css' rel='stylesheet' />
    <div class="mx-auto max-w-[900px]">
        <x-error />
        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
            <div>
                <div class="font-bold py-2 uppercase">Mark Pick Up Location</div>
                <div id='map-pu' class="w-full h-[300px]"></div>
            </div>
            
            <div>
                <div class="font-bold py-2 uppercase">Mark Destination</div>
                <div id='map-des' class="w-full h-[300px]"></div>
            </div>
        </div>
        <form action="{{route('booking.post')}}" method="POST">
             @csrf 
            <input type="hidden" name="destination" id="des">
            <input type="hidden" name="origin" id="pu">
            <input class="p-4 w-full mt-2 border" name="number_of_passenger" type="number" placeholder="Number of passenger">
            <button class="bg-blue-800 font-bold p-2 text-[24px] text-white border-r-4 border-b-4 border-gray-300 mt-4">SUBMIT NOW</button>
        </form>
    </div>
    <script>
        const pIn = document.getElementById('pu')
        const dIn = document.getElementById('des')
    mapboxgl.accessToken = 'pk.eyJ1IjoiZWxlemVya3ciLCJhIjoiY2wxNHE4d2E5MHRvMTNkczA1anltY3lybSJ9.T2bcLRSnEZB_LNGM7Qs5Mw';
    const map = new mapboxgl.Map({
        container: 'map-pu', // container ID
        style: 'mapbox://styles/mapbox/streets-v12', // style URL
        center: [-74.5, 40], // starting position [lng, lat]
        zoom: 9, // starting zoom
    });

    const des = new mapboxgl.Map({
        container: 'map-des', // container ID
        style: 'mapbox://styles/mapbox/streets-v12', // style URL
        center: [-74.5, 40], // starting position [lng, lat]
        zoom: 9, // starting zoom
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

    map.on('click', (e) => {
        if (marker == null) {
            marker = new mapboxgl.Marker({
                color: '#1e40af',
                draggable: true, 
            })
            .setLngLat(e.lngLat)
            .addTo(map);
        } else {
            marker.setLngLat(e.lngLat)
        }
        let {lat, lng} = e.lngLat
        pIn.value = [lng, lat].join(',')
    })

    des.on('click', (e) => {
        if (desMarker == null) {
            desMarker = new mapboxgl.Marker({
                color: '#1e40af',
                draggable: true, 
            })
            .setLngLat(e.lngLat)
            .addTo(des);
        } else {
            desMarker.setLngLat(e.lngLat)
        }
        
        let {lat, lng} = e.lngLat
        dIn.value = [lng, lat].join(',')
    })

    desGeolocate.on('geolocate', ({coords}) => {
        desMarker.setLngLat([coords.longitude, coords.latitude + .01])
        dIn.value = [coords.longitude, coords.latitude + .01].join(',')
    })

    geolocate.on('geolocate', ({coords}) => {
        marker.setLngLat([coords.longitude, coords.latitude + .01])
        pIn.value = [coords.longitude, coords.latitude + .01].join(',')
    })
    </script>
</x-layout>