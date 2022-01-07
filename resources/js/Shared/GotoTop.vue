<template>
    <a v-if="show" href="#" class="z-50 bg-yellow-900 text-white text-2xl p-2 rounded-full fixed bottom-4 right-4">
<svg xmlns="http://www.w3.org/2000/svg" width="42" height="42" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-up"><line x1="12" y1="19" x2="12" y2="5"></line><polyline points="5 12 12 5 19 12"></polyline></svg>
    </a>
</template>

<script>
    export default {
        data(){
            return {
                show:false,
            }
        },
        methods: {
            init() {
                window.addEventListener('scroll', (e)=>{
                    if(window.scrollY >= 12) {
                        this.show = true;
                    }else {
                        this.show = false;
                    }
                })
            }
        },
        mounted() {
            this.init();
        }
    }
</script>
