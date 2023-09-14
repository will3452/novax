<template>
    <div>
        <a-steps :current="currentStep">
            <a-step title="Pick-up Location">
            </a-step>
            <a-step title="Drop Location" />
            <a-step title="Select Provider" />
        </a-steps>
        <br/>

        <div v-show="currentStep == 2">
            Selecting Provider is on going development.
        </div>
        <div v-show="currentStep == 0 || currentStep == 1">
            <a-alert type="info" message="pin the location." style="margin-bottom: 1em;"></a-alert>
            <l-map :center="[lat , lng ]" style="height:300px; " :zoom="18" >
            <l-tile-layer url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"/>
            <l-marker draggable :lat-lng="[lat , lng ]" @update:lat-lng="markerChange">
                <l-icon>
                    <img  src="../pin.png"  style="width:25px;" class="blink">
                </l-icon>
            </l-marker>
        </l-map>
        </div>
       <div>
        <br>
        <a-button type="secondary" :disabled="currentStep == 0" @click="currentStep--">
            PREVIOUS
        </a-button>
        <a-button type="primary" @click="next" v-text="currentStep == 2 ? 'SUBMIT': 'NEXT'"></a-button>
       </div>
    </div>
</template>

<script>
import MainVue from '../Layouts/Main.vue'
export default {
    layout: MainVue,
    methods: {
        next(e) {
            this.payload.steps[this.currentStep] = {lat: this.lat, lng: this.lng};
            this.currentStep++;
        },

        markerChange(event) {
            this.lat = event.lat;
            this.lng = event.lng;
            console.log(event);
        }

    },
    mounted() {
        navigator.geolocation.getCurrentPosition((position) => {
            let {coords} = position;
            this.lat = coords.latitude;
            this.lng = coords.longitude;
        })
    },
    data() {
        return {
            currentStep: 0,
            lat: 0,
            lng: 0,
            payload: this.$inertia.form({
                from_coords:'',
                to_coords: '',
                steps:[],
            }),
        }
    }
}
</script>

<style>
.blink {
    animation-name: blinking;
    animation-duration: 1000ms;
    animation-iteration-count: infinite;
    animation-timing-function: linear;
}
    @keyframes blinking {
        10% {
            width: 25px;
        };
        100% {
            width: 30px;
        }
    }
</style>
