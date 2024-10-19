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
        this.loadStatus()
    }
}
</script>
