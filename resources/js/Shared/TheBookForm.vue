<template>
    <div id="booking" @click="focusHandler()" class="mx-20 border-8 border-amber-600 p-12 shadow-xl bg-gray-100">
        <form action="" class="flex justify-start">
            <input type="date" class="text-lg border-4 w-1/3 p-4 mx-2" >
            <input type="date" class="text-lg border-4 w-1/3 p-4 mx-2">
            <button class="text-2xl font-bold uppercase border-2 text-white tracking-widest w-1/3 p-4 mx-2 bg-yellow-600" >BOOK NOW</button>
        </form>
    </div>
</template>

<script>
    export default {
        methods: {
            focusHandler(){
                this.$emit('custom-click');
            }
        }
    }
</script>
