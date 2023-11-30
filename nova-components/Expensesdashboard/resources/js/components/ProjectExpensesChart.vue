<template>
    <div>
        <h4>Projects</h4>
        <chart :key="key" :width="400" type="pie" :options="chartOptions" :series="dataSources.map( e => parseInt(e.budget))"/>
    </div>
</template>


<script>
import VueApexCharts from 'vue-apexcharts'
import axios from 'axios';
import moment from 'moment';

export default {
    components: {
        chart: VueApexCharts, 
    }, 
    props: ['dataSources'], 
    data() {
        return {
            key: 1, 
        }
    },
    mounted() {
        setTimeout(() => {
            this.key ++;
        }, 10)
    }, 
    computed: {
        chartOptions() {
            return {
                chart: {
                    id: 'vue-example', 
                },
                labels: this.dataSources.map( e => e.name), 
            }; 
        }
    }
}
</script>