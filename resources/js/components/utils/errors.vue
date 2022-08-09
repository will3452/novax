<template>
    <ul>
        <li v-for="error in errors" :key="error">
            {{Array.isArray(error) ? error.toString() : error}}
        </li>
    </ul>
</template>

<script>
export default {
    props: ['errors'],
}
</script>

<style scoped>
    ul > * {
        color: red !important;
    }
</style>
