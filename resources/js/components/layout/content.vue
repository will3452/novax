<template>
    <a-col :xs="24" :md="20" style="padding: 1em">
        <div v-if="! loading">
            <slot></slot>
        </div>
        <div v-else>
            <a-skeleton active  />
        </div>
    </a-col>
</template>
<script>
    export default {
        data () {
            return {
                loading: true,
            }
        },
        created () {
            window.onload = () => {
                this.loading = false
            }
        },
    }
</script>
