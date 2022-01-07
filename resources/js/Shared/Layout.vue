<template>
    <the-header></the-header>

    <div>
        <slot></slot>
    </div>

    <goto-top></goto-top>

</template>

<script setup>
import { defineComponent, ref } from 'vue';
import TheHeader from '../Shared/TheHeader.vue';
defineComponent({
    TheHeader,
});


</script>
