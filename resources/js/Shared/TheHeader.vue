<template>
    <header class="bg-yellow-600 relative h-20 flex items-center justify-end px-8">
        <Link href="/" ><default-logo class="absolute w-32 -top-6 left-10"></default-logo></Link>
        <ul class="flex list-none uppercase space-x-12 text-2xl text-white tracking-wider">
            <li class="border-4 border-yellow-600 hover:border-white px-4 ease-linear transition-all py-2" >
                 <Link href="/#service">Services</Link>
            </li>
            <li class="border-4 border-yellow-600 hover:border-white px-4 ease-linear transition-all py-2" >
                <Link href="/#contact">Contacts</Link>
            </li>
            <li class="border-4 border-yellow-600 hover:border-white px-4 ease-linear transition-all py-2" >
                <Link href="/register">Register</Link>
            </li>
        </ul>
    </header>
    <div class="h-4 bg-amber-900">
    </div>
</template>

<script setup>
import { defineComponent } from 'vue';
import DefaultLogo from '../Shared/DefaultLogo.vue';

defineComponent({
    DefaultLogo,
})
</script>
