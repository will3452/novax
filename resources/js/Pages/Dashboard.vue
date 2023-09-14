<template>
    <div>
        <a-row :gutter="[18, 18]">
            <a-col>
                <h2>Your current Location</h2>
                <a-spin :spinning="this.loading">
                    <l-map
                        @click="clickHandler"
                     @ready="() => {
                        this.loading = false
                    }" ref="map" style="height: 300px;" :zoom="20" :center="[lat, lng]">
                            <l-tile-layer url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"/>
                            <l-marker @update:lat-lng="markerChange"  :lat-lng="[lat, lng]" :draggable="true">
                                <l-icon>
                                    <img src="../pin.png" style="width:25px;" alt="">
                                </l-icon>
                            </l-marker>
                    </l-map>
                </a-spin>
            </a-col>
            <a-col>
                <a-button size="large" type="primary" icon="arrow-up" block @click="$inertia.visit('/booking')">
                    Book Now
                </a-button>
            </a-col>
        </a-row>
    </div>
</template>


<script>
import MainVue from '../Layouts/Main.vue'
export default {
    layout: MainVue,
    mounted() {
        navigator.geolocation.getCurrentPosition((position) => {
            let {coords} = position;
            this.lat = coords.latitude;
            this.lng = coords.longitude;
        })
    },
    methods: {
        clickHandler(event) {
            console.log(event)
        },
        markerChange(event) {
            console.log(event);
        }
    },
    data() {
        return {
            lat:0,
            lng: 0,
            loading: true,
        }
    }
}
</script>
