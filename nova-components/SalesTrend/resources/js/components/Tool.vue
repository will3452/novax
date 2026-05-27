<template>
    <div class="px-6 py-4">
        <h1 class="text-xl font-bold mb-4">Sales Trend</h1>
        <canvas id="chart"></canvas>
    </div>
</template>

<script>
import Chart from 'chart.js/auto'

export default {

mounted(){

fetch('/api/product-trend/2206/day')
.then(res => res.json())
.then(data => {

new Chart(document.getElementById('chart'),{
type:'line',
data:{
labels:data.labels,
datasets:[{
label:'Sales',
data:data.sales
}]
}
})

})

}

}
</script>

<script>
export default {
    metaInfo() {
        return {
          title: 'SalesTrend',
        }
    },
    mounted() {
        //
    },
}
</script>

<style>
/* Scoped Styles */
</style>
