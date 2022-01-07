<template>
    <div class="w-1/4 h-52 shadow-black relative overflow-hidden mx-2 cursor-pointer" @mouseenter="show = true" @mouseleave="show = false">
        <img src="//picsum.photos/200" alt="" class="w-full object-cover object-center absolute">
        <div  class="text-lg transition-all ease-linear w-full p-4 bg-yellow-600 text-white text-center absolute bottom-0" :class="{'translate-y-16':!show}">
            sample captions
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            show:false,
        }
    }
}
</script>
