<template>
    <div>
        <div>
            <div class="text-center" style="font-size: 32px;font-weight: 900;">
                {{ time.toLocaleTimeString() }}
            </div>
            <button @click="submit" class="btn btn-primary w-100" v-if="!isTimeOut">
                Time In
            </button>

            <button @click="submit" class="btn btn-danger w-100" v-else>
                Time Out
            </button>
        </div>
    </div>
</template>

<script>
export default {
    props: ['userId'],
    data() {
        return {
            time: new Date(),
            isTimeOut: false,
            place:null,
        }
    },
    methods: {
        async loadStatus() {
            let response = await axios.get(`/api/time-status?userId=${this.userId}`,)
            this.isTimeOut = response.data;
        },
        async submit() {
            try {
                let response = await axios.post('/api/time', {
                    userId: this.userId,
                    place: this.place,
                })
            } catch (error) {
                console.log('error -> ', error)
            } finally {
                this.loadStatus()
            }
        }
    },
    mounted() {
        setInterval(() => {
            this.time = new Date()
        }, 1000);
        if (! navigator.geolocation) {
            alert('Geolocation is not supported by your browser!');
        } else {
            let positionHandler  = (pos) => {
                const { latitude, longitude } = pos.coords;
                console.log(latitude, longitude);
                this.place = `${latitude},${longitude}`;
            }
            navigator.geolocation.getCurrentPosition(positionHandler)
        }
        this.loadStatus()
    }
}
</script>
