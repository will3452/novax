<template>
    <div>
        <h4>Expenses</h4>
        <chart style="width:100%" type="area" :options="chartOptions" :series="[ {
                        name: 'Expenses',
                        data: dataSources.map( e => ([e.label, parseFloat(e.value)]))
                    }]"/>
    </div>
</template>


<script>
import VueApexCharts from 'vue-apexcharts'
import axios from 'axios';
import moment from 'moment';

export default {
    props: ['dataSources'], 
    components: {
        chart: VueApexCharts, 
    }, 
    data() {
        return {
            chartOptions: {
                colors: ['red'], 
                fill: {
                    colors: ['red']
                }, 
                markers: {
                    colors: ['red']
                }, 
                chart: {
                    id: 'vue-example', 
                },
            }
        }
    }
}
</script>