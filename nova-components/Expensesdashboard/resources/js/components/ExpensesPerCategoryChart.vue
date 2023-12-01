<template>
    <div>
        <h4>Category Expenses</h4>
        <chart :key="key" style="width:80%" type="pie" :options="chartOptions" :series="dataSources.map( e => e.value)"/>
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
            try {
                return {
                chart: {
                    id: 'vue-example', 
                },
                labels: this.dataSources.map( e => `Category ${e.label}`), 
            }; 
            } catch(error) {
                return {
                    chart: {
                        id: 'vue-example3', 
                    },
                    labels: []
                }; 
            }
        }
    }
}
</script>