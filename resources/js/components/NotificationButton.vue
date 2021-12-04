<template>
    <div class="text-center">
        <button v-if="!readat.length" @click="markAsRead" class="btn btn-ghost btn-xs" :class="{'loading':isLoading}">
            Mark as read
        </button>
        <div v-if="readat.length" class="text-xs font-bold text-success">
            Done!
        </div>
    </div>
</template>


<script>
    export default {
        props: ['readat', 'notificationid'],
        methods: {
            markAsRead(){
                this.isLoading = true;
                axios.post(`/notifications/${this.notificationid}`)
                    .then((response)=>{
                        if (response.status === 200) {
                            this.isLoading = false;
                            this.readat = 'now';
                        }
                    })
            }
        },
        data() {
            return {
                isLoading: false,
            };
        }
    }
</script>
