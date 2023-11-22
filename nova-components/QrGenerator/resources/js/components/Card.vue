<template>
   <div>
    <card class="mb-2">
        <div class="text-center  p-4">
            <p class="text-md flex justify-between"><span>Additional Fare:</span> <span>{{ card.ads_fare }}</span></p>
            <p class="text-md flex justify-between"> <span>Status:</span> <span> {{ card.status.split('_').join(' ').toLowerCase() }}</span></p>
        </div>
    </card>
    <card class="flex flex-col items-center justify-center h-auto">
        <vue-final-modal v-model="showScanner" :esc-to-close="true" >
            <div class="flex justify-center items-center h-screen">
                <div  class="bg-white p-4 inline-block">
                    <div >
                        <!-- <div>
                            <div class="flex">
                                <input :disabled="toggleSet" type="number" min="1" v-model="amount" class="mb-2 border-2 form-control input rounded block" placeholder="₱ 100.00">
                                <button class="btn btn-default btn-primary mx-2 " @click="toggleSet = ! toggleSet">{{toggleSet ? 'CHANGE AMOUNT': 'SET AMOUNT'}}</button>
                            </div>
                            <div>
                                <textarea v-model="purpose" id="" class="input w-full border form-control input rounded" placeholder="Input purpose here"></textarea>
                            </div>
                        </div> -->
                        <qr-code-stream @decode="onDecode" @init="onInit" :track="paintOutline">
                            <b class="text-white p-2">Current Location: {{`Lat: ${lat} Lng: ${lng}` || '-'}}</b>
                        </qr-code-stream>
                    </div>
                </div>
            </div>
        </vue-final-modal>
        
        <div class="px-3 py-3">
            <h1 class="text-sm text-center">Qr Code</h1>
            <qr-code :text="JSON.stringify({code,user_id: card.user_id})" v-if="code" class="my-4" error-level="L"></qr-code>
            <div class="text-center mt-4">
                <button class="btn btn-default btn-primary" @click="generateCode">GENERATE</button>
                <button class="btn btn-default btn-primary" @click="scan">SCAN</button>
            </div>
        </div>
    </card>
   </div>
</template>

<script>
import axios from 'axios'
export default {
    props: [
        'card',

        // The following props are only available on resource detail cards...
        // 'resource',
        // 'resourceId',
        // 'resourceName',
    ],
    methods: {
        async onInit (promise) {
        try {
            await promise
        } catch (error) {
            if (error.name === 'NotAllowedError') {
            this.error = "ERROR: you need to grant camera access permission"
            } else if (error.name === 'NotFoundError') {
            this.error = "ERROR: no camera on this device"
            } else if (error.name === 'NotSupportedError') {
            this.error = "ERROR: secure context required (HTTPS, localhost)"
            } else if (error.name === 'NotReadableError') {
            this.error = "ERROR: is the camera already in use?"
            } else if (error.name === 'OverconstrainedError') {
            this.error = "ERROR: installed cameras are not suitable"
            } else if (error.name === 'StreamApiNotSupportedError') {
            this.error = "ERROR: Stream API is not supported in this browser"
            } else if (error.name === 'InsecureContextError') {
            this.error = 'ERROR: Camera access is only permitted in secure context. Use HTTPS or localhost rather than HTTP.';
            } else {
            this.error = `ERROR: Camera error (${error.name})`;
            }
        }
        },
        async generateCode() {
            try {
                const { data } = await this.axios.get('/api/get-code?user_id=' + this.card.user_id)
                this.code = data
            } catch (error) {
                console.log('generatedCode error >> ', error)
            }
        },
        scan () {
            this.showScanner = true
        },
        async onDecode(decoded) {
            try {
                let payload = JSON.parse(decoded)
                if ("code" in payload && "user_id" in payload) {
                    payload.auth_id = this.card.user_id
                    payload.lat = this.lat
                    payload.lng = this.lng

                    const {data} = await this.axios.post('/api/pay', payload)


                    if (! data.pay) throw new Error(data.message);

                    this.$toasted.success('Success!');
                }
            } catch (error) {
                this.$toasted.error(error)
                console.log("onDecode error >> ", error)
            }
        },
        paintOutline (detectedCodes, ctx) {
        for (const detectedCode of detectedCodes) {
                const [ firstPoint, ...otherPoints ] = detectedCode.cornerPoints

                ctx.strokeStyle = "red";

                ctx.beginPath();
                ctx.moveTo(firstPoint.x, firstPoint.y);
                for (const { x, y } of otherPoints) {
                ctx.lineTo(x, y);
                }
                ctx.lineTo(firstPoint.x, firstPoint.y);
                ctx.closePath();
                ctx.stroke();
            }
        },
        showPosition ({coords}) {
            this.lat = coords.latitude
            this.lng = coords.longitude
        },
        loadAddress() {
            if (navigator.geolocation){
                navigator.geolocation.getCurrentPosition(this.showPosition);
            }
        }
    },
    data () {
        return {
            currentLocation: '',
            axios,
            code: null,
            showScanner: false,
            amount: null,
            purpose: null,
            lat: 0,
            lng: 0,
        }
    },
    mounted() {
        this.loadAddress()

        setInterval(async () => {
            let payload = {}
            payload.lat = this.lat;
            payload.lng = this.lng; 
            payload.userId = this.card.user_id
            await this.axios.post('/api/update-location', payload); 
        }, 5000); 
    },
}
</script>
