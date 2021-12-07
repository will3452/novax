<template>
    <div class="inline-block" >
        <div class="bg-danger text-white p-1 rounded" v-if="count">
        </div>
    </div>
</template>

<script>
import axios from 'axios';
    export default {
        data() {
            return {
                count:0,
            }
        },
        mounted () {
            setInterval(() => {
                axios.get('/nova-vendor/newsfeed')
                    .then(res=>{
                        this.count = res.data.count;
                    });
            }, 3000);
        }
    }
</script>
