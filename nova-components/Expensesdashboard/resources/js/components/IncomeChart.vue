<template>
    <div>
        <h4>Income</h4>
        <chart :width="400" type="bar" :options="chartOptions" :series="[ {
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
            chartOptions: {
                chart: {
                    id: 'vue-example', 
                },
                xaxis: {
                    type: 'datetime',
                }, 
            }
        }
    }
}
</script>