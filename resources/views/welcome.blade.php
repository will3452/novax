<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
   integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
   crossorigin=""/>
   <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
   integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin=""></script>
   <style>
       #map { height: 300px; width: 500px;}
   </style>
   <script src="//unpkg.com/alpinejs" defer></script>
   <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="flex justify-center m-10" x-data="{
        frams:[],
        map:null,
        addTag:false,
        mark:null,
        positions:[],
        setColor:false,
        color:'#000000',
        fillColor:'#000000',
        m1:'mapbox/satellite-v9',
        m2:'mapbox/streets-v11',
        idMap:'mapbox/streets-v11',
        setTileLayer() {
            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                attribution: '',
                maxZoom: 18,
                {{-- id: , --}}
                id: this.idMap,
                {{--  --}}
                tileSize: 512,
                zoomOffset: -1,
                accessToken: 'pk.eyJ1IjoiZWxlemVya3ciLCJhIjoiY2wxNHE4d2E5MHRvMTNkczA1anltY3lybSJ9.T2bcLRSnEZB_LNGM7Qs5Mw'
            }).addTo(this.map);
        },
        reset() {
            this.positions = [];
            this.addTag = false;
            this.mark.remove();
        },
        draw() {
            this.mark = L.polygon(this.positions, {color:this.color, fillColor:this.fillColor, opacity:0.7}).addTo(this.map);
        },
        render() {
            if (this.mark) {
                this.mark.remove();
            }
            this.draw();
        },
        save() {
            this.addTag = false;
        },
        init() {
            this.map = L.map('map').setView([17.57472, 120.38694], 14);
            this.setTileLayer();
            @foreach($farms as $farm)
                let f{{$farm->id}} = L.polygon([
                    @foreach(explode(',', $farm->coordinates) as $p)
                        @if($loop->odd)[{{$p}},@else{{$p}}],@endif
                    @endforeach
                ], {color:`{{$farm->color}}`, fillColor:`{{$farm->fill}}`}).addTo(this.map);
                f{{$farm->id}}.bindPopup('{{$farm->farmer->name}}')

            @endforeach
            this.map.on('click', (e)=>{
                if (this.addTag) {
                    let newPos = [];
                    newPos.push(e.latlng.lat);
                    newPos.push(e.latlng.lng);
                    this.positions.push(newPos);
                    this.render();
                    console.log(this.positions)
                }
            }); // when click
        },
        submit() {
            this.$refs.form.submit();
        }
    }">
        <div>
            <div id="map"></div>
            <div class="flex justify-center">
                <button class="p-2 text-sm py-1 rounded-2xl shadow bg-orange-700 text-white m-1"  x-on:click="idMap = idMap == m1 ? m2: m1; setTileLayer()">Change Map</button>
                <button x-show="! addTag" class="p-2 text-sm py-1 rounded-2xl shadow bg-blue-800 text-white m-1"  x-on:click="addTag = true">Set Tag</button>
                <button x-show="addTag" class="p-2 text-sm py-1 rounded-2xl shadow bg-green-700 text-white m-1"  x-on:click="save()">Apply</button>
                <button x-show="addTag" class="p-2 text-sm py-1 rounded-2xl shadow bg-red-900 text-white m-1"  x-on:click="reset()">Reset</button>
                <button type="button" class="p-2 text-sm py-1 rounded-2xl shadow bg-yellow-900 text-white m-1" x-on:click="setColor = true" x-show="!setColor">set color</button>
                <button x-on:click="submit()" class="p-2 text-sm py-1 rounded-2xl shadow bg-gray-900 text-white m-1">Submit</button>
            </div>
            <form action="/map/{{request()->farm}}" method="POST" x-ref="form">
                @csrf
                <textarea name="coordinates" class="hidden" x-model="positions" id="" cols="30" rows="10"></textarea>
                <div x-show="setColor">
                    Borders Color: <input name="color" type="color" x-model="color">
                    Fill Color:<input name="fill" type="color" x-model="fillColor">
                    <button type="button" x-on:click="setColor = false; render()" class="p-2 text-sm py-1 rounded-2xl shadow bg-gray-900 text-white m-1">Apply Colors</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
