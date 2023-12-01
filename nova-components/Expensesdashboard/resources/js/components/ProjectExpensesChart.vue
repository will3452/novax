<template>
    <div>
        <h4>Project budgets</h4>
        <chart :key="key" style="width:100%" type="area" :options="chartOptions" :series="[ {
                        name: 'Income',
                        data: dataSources.map( e => ([e.label, e.value])), 
                    }]"/>
    </div>
</template>


<script>
import VueApexCharts from 'vue-apexcharts'

export default {
    components: {
        chart: VueApexCharts, 
    }, 
    props: ['dataSources'],
    data() {
        return {
            key:1, 
            chartOptions: {
                chart: {
                    id: 'vue-example1', 
                },
                xaxis: {
                    categories: [], 
                }
            }
        }
    }
}
</script>