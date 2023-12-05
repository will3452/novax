<template>
    <div>
        <h4>Expenses</h4>
        <chart :key="key" style="width:100%" type="area" :options="chartOptions"
                    :series="[{name: 'Expenses', data: dataSources.map(e => parseFloat(e.value))}]"
                    />
    </div>
</template>


<script>
import VueApexCharts from 'vue-apexcharts'
import axios from 'axios';
import moment from 'moment';

export default {
    props: ['dataSources', 'key'], 
    components: {
        chart: VueApexCharts, 
    }, 
    mounted() {
        this.chartOptions.xaxis.categories = this.dataSources.map(e => `${e.label}`)
    }, 
    computed: {
        chartOptions() {
            return  {
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
                xaxis: {
                    categories: this.dataSources.map(e => `${e.label}`), 
                }
            };
        }
    }
}
</script>