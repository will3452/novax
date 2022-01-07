<template>
    <div class="text-center font-serif my-20">
        <h1 class="text-8xl text-amber-900 uppercase tracking-widest">
            Lapito Hotel
        </h1>
        <h3 class="text-2xl text-gray-800 mt-2">
            Enjoy Vacation, Visit our hotel
        </h3>
        <a href="#booking" @click="clickHandler()" class="transition ease-linear tracking-widest hover:bg-yellow-900 hover:shadow-md uppercase font-bold inline-block bg-yellow-600 text-4xl p-5 my-8 rounded-full text-white w-1/4">
            Book Now
        </a>
    </div>
</template>

<script>

export default {
    methods: {
        clickHandler() {
            this.$emit('goto-book-form');
        }
    }
}
</script>
