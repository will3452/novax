<template>
<div>
    <div class="alert mb-2" v-if="!isverify">
        <div class="flex-1">
            <label class="mx-3">You're Email is not yet verify!</label>
        </div>
        <div class="flex-none">
            <button v-if="!hasSend" @click="sendVerification" class="btn btn-sm btn-primary " :class="{'loading':isLoading}">Send Verification</button>
            <button class="btn btn-sm btn-ghost" v-if="hasSend">
                <icon>done_all</icon>
                <span class="ml-2">Verification has been sent!</span>
            </button>
        </div>
    </div>
</div>
</template>

<script>
    export default {
        props: ['isverify'],
        data() {
            return {
                isLoading:false,
                hasSend:false,
            }
        },
        methods: {
            sendVerification() {
                this.isLoading = true;
                axios.post('/send-verification')
                    .then(res=>{
                        this.isLoading = false;
                        if(res.status == 200) {
                            this.hasSend = true;
                        }
                    }).catch(err=>{
                        this.isLoading = false;
                        alert('Server Errror!');
                    })
            }
        }
    }
</script>
