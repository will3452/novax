<template>
    <a-card :loading="loading" title="Location">
        <l-map style="height: 400px" :zoom="zoom" :center="center">
            <l-tile-layer :url="url" :attribution="attribution"></l-tile-layer>
            <l-marker :lat-lang="center"></l-marker>
        </l-map>
    </a-card>
</template>
<script>
import { LMap, LTileLayer, LMarker } from 'vue2-leaflet';
export default {
    async mounted () {
        await this.getCurrentLocation()
    },
    components: {
        LMap,
        LTileLayer,
        LMarker,
    },
    methods: {
        async getCurrentLocation () {
            try {
                await navigator.geolocation.getCurrentPosition( (position) => {
                    let { coords } = position
                    this.center = []
                    this.center.push(coords.latitude)
                    this.center.push(coords.longitude)
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
            url: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
            attribution:
                '&copy; <a target="_blank" href="http://osm.org/copyright">OpenStreetMap</a> contributors',
            zoom: 20,
            center: [47.313220, -1.319482],
            loading: true,
        }
    }
}
</script>
