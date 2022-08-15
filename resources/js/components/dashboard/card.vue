<template>
    <a-card :style="style" :loading="loading" class="card" >
        <div style="display:flex; justify-content:space-between; align-items:center;margin-bottom: 1em;">
            <h1 style="color:#fff !important; text-transform: uppercase;">{{label}}</h1>
            <a-icon :type="icon" style="font-size: 24px"></a-icon>
        </div>
        <div>
            <slot></slot>
        </div>
    </a-card>
</template>

<script>
export default {
    props: ['style', 'label', 'icon'],
    data() {
        return {
            loading: true,
        }
    },
    mounted () {
        this.loading = false
    }
}
</script>

<style scoped>
.card {
    margin: .5em;
    width: 300px;
}
@media screen and (max-width: 600px){
    .card {
        width: 100%;
    }
}
</style>
