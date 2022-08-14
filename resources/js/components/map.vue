<template>
    <div>
        <a-card :loading="loading" title="Location">
            <a slot="extra" href="/map">
                 <a-icon type="reload" title="refresh map"/>
            </a>
            <l-map style="height: 400px" :zoom="zoom" :center="center">
                <l-tile-layer :url="url" :attribution="attribution"></l-tile-layer>
                <l-marker :lat-lng="center" :icon="icon">
                    <l-popup>You</l-popup>
                </l-marker>
            </l-map>
        </a-card>
        <a-icon type="refresh"></a-icon>
         Refresh map </a-button>
    </div>
</template>
<script scoped>
import 'leaflet/dist/leaflet.css';
import { LMap, LTileLayer, LMarker, LPopup } from 'vue2-leaflet';
export default {
    props: ['userId'],
    async mounted () {
        await this.getCurrentLocation()
    },
    components: {
        LMap,
        LTileLayer,
        LMarker,
        LPopup,
    },
    methods: {
        async getCurrentLocation () {
            try {
                this.loading = true
                this.$message.info('Retrieving your location');
                await navigator.geolocation.getCurrentPosition( async (position) => {
                    let { coords } = position
                    this.center = []
                    let lat = coords.latitude
                    let lng = coords.longitude
                    this.center.push(lat)
                    this.center.push(lng)
                    let user = this.userId
                    let updateLocationPayload = {
                        user,
                        lat_lng: [lat, lng]
                    }
                    await window.axios.post('api/user-location-update', updateLocationPayload)
                    this.$message.success('location saved!');
                })
            } catch (err) {
                this.$notification.error({message: 'Error', description: 'Geolocation not supported.'})
            } finally {
                this.loading = false
            }
        }
    },
    data () {
        return {
            // url: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
            url: 'https://api.maptiler.com/maps/pastel/{z}/{x}/{y}.png?key=CgyD1wN4YHJXmmA2syOT',
            attribution:
                '&copy; bms',
            zoom: 32,
            center: [47.313220, -1.319482],
            loading: true,
            icon: L.icon({
                iconUrl: '/images/vendor/leaflet/dist/marker-icon.png',
                iconSize: [26, 38],
            }),
        }
    }
}
</script>
