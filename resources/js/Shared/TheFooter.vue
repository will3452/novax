<template>
    <div class="z-0 h-48 p-8 bg-yellow-700 mt-20 relative border-b-8 border-amber-900" id="contact">
        <default-logo class="absolute right-16 w-32 -top-24"></default-logo>
        <div class="text-white">
            <h2 class="text-4xl font-bold uppercase">
                Contact Us
            </h2>
            <p class="text-lg text-white pt-2">
                +639-456-7891 | frontdesk@lapito.org
            </p>
            <p class="text-lg text-white pt-2">
                San Roque, Tarlac, Tarlac - 2314
            </p>
        </div>
    </div>
</template>

<script setup>
import { defineComponent } from 'vue';
import DefaultLogo from './DefaultLogo.vue';

defineComponent({
    DefaultLogo,
})
</script>
