<template>
    <div class="text-center my-20 font-serif" id="service">
        <h2 class="tracking-widest text-7xl text-amber-800 pb-4 px-4 border-b-4 border-amber-800 inline-block">
            Services
        </h2>
        <p class="my-4 w-2/4 mx-auto text-lg tracking-wide text-gray-700">
            <span v-for="(service, index) in services" :key="index">
                {{service}}
                <span v-if="index != 0 && index != services.length - 1" class="mx">
                    *
                </span>
            </span>
        </p>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                services: [
                    'Table service',
                    'English Service',
                    'Family Style F&B Service',
                    'French service',
                    'Silver service',
                    'American / Pre-plated service etc',
                    'Table service',
                    'English Service',
                    'Family Style F&B Service',
                    'French service',
                    'Silver service',
                    'American / Pre-plated service etc'
                ],
            }
        }
    }
</script>
