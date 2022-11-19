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
                <l-marker :lat-lng="JSON.parse(bus.lat_lng)" :icon="iconBus" v-for="bus in conductors" :key="bus.id">
                    <l-popup>{{bus.buses[0].company_name + ' - ' + bus.buses[0].plate_number}}</l-popup>
                </l-marker>

            </l-map>
        </a-card>
    </div>
</template>
<script scoped>
import { LMap, LTileLayer, LMarker, LPopup } from 'vue2-leaflet';
export default {
    props: ['userId'],
    async mounted () {
        await this.getCurrentLocation()
        await this.loadConductors()
    },
    components: {
        LMap,
        LTileLayer,
        LMarker,
        LPopup,
    },
    methods: {
        async loadConductors () {
            try {
                this.$message.info('fetching data...please wait')
                let response = await window.axios.get('/api/conductors')
                this.conductors = response.data
            } catch (err) {
                this.$message.error('fetching data error.')
            }
        },
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
            conductors: [],
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
           iconBus: L.icon({
            iconUrl: '/bus.png',
            iconSize: [38, 38],
           })
        }
    }
}
</script>
