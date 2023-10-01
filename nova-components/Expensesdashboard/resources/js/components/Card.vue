<template>
    <div class="h-screen">
        <div class="flex">
            <div class="h-1/3 w-1/3 flex justify-center items-center">
                <img src="/logo.png" class="rounded-full" style="max-width: 250px; " alt="">
            </div>
            <div class="h-1/3 w-1/3 border border-grey-300 m-1 rounded">
                <div class="p-2 font-bold">
                    Expenses per day
                </div>
                <apexcharts  v-if="loaded" class="w-full h-full" type="line" :options="expensesPerDay.chartOptions" :series="expensesPerDay.series"></apexcharts>
            </div>
            <div class="h-1/3 w-1/3 border border-grey-300 m-1 rounded">
                <div class="p-2 font-bold">
                    Expenses per Category
                </div>
                <apexcharts v-if="loaded" class="w-full h-full" type="bar" :options="expensesPerCategory.chartOptions" :series="expensesPerCategory.series"></apexcharts>
            </div>
        </div>
        <div class="flex">
            <div  class="h-1/3 w-1/2 border border-grey-300 m-1 rounded">
                <div class="p-2 font-bold">
                    Expenses per Project
                </div>
                <apexcharts v-if="loaded"  width="500" height="350" type="donut" :options="projectOptions" :series="projectSeries"></apexcharts>
            </div>
            <div class="h-1/3 w-1/2 border border-grey-300 m-1 rounded">
                <div class="p-2 font-bold">
                    Expenses per Day, Project and Categories
                </div>
                <apexcharts v-if="loaded" class="w-full h-full" type="line" :options="chartOptions" :series="series"></apexcharts>
            </div>
        </div>
    </div>
</template>

<script>
import VueApexCharts from 'vue-apexcharts'
import axios from 'axios';
import moment from 'moment';

export default {
    name: 'Chart',
    components: {
        apexcharts: VueApexCharts,
    },
    async mounted() {
        const {data} = await this.axios.get('/dashboard')
        console.log(data);

        this.expensesPerDay.chartOptions.xaxis.categories = data.expenses_per_day.map(item => this.moment(item.date).format('MM/DD/YY'));
        this.expensesPerDay.series[0].data = data.expenses_per_day.map(item => item.total);

        this.expensesPerCategory.chartOptions.xaxis.categories = data.expenses_per_category.map( item => item.name);
        this.expensesPerCategory.series[0].data = data.expenses_per_category.map(item => {
            let total = 0;
            for (let expense of item.expenses) {
                total += parseFloat(expense.amount);
            }

            return parseInt(total);
        });


        this.projectSeries = data.expenses_per_project.map(item => {
            let total = 0;
            for (let expense of item.expenses) {
                total += parseFloat(expense.amount);
            }

            return parseInt(total);
        });

        this.projectOptions.labels = data.expenses_per_project.map(item => item.name);


        // overall
        let categories = data.expenses_per_day.map(item => this.moment(item.date).format('MM/DD/YY'));
        this.chartOptions.xaxis.categories = categories;
        this.series[0].data = data.expenses_per_day.map(item => item.total);
        this.series[0].name = "Per Day";
        this.series[1].name = "Per Project";
        this.series[1].data = [];
        this.series[2].name = "Per Category";
        this.series[2].data = [];

        for (let i = 0; i < categories.length; i ++) {
            let total = 0;

            data.expenses_per_project.forEach( project => {
                for (let _exp of project.expenses) {
                    if (this.moment(_exp.date).format('MM/DD/YY') == categories[i]) {
                        total += parseFloat(_exp.amount);
                    }
                }
            })

            this.series[1].data.push(total);
        }

        for (let i = 0; i < categories.length; i ++) {
            let total = 0;

            data.expenses_per_category.forEach( cat => {
                for (let _exp of cat.expenses) {
                    if (this.moment(_exp.date).format('MM/DD/YY') == categories[i]) {
                        total += parseFloat(_exp.amount);
                    }
                }
            })

            this.series[2].data.push(total);
        }


        this.loaded = true;
    },
    methods: {
        moment,
    },
    data() {
        return {
            loaded: false,
            axios,
            projectOptions: {},
            projectLabels: [],
            expensesPerDay: {
                chartOptions: {
                    chart: {
                        id: 'expenserPerDay',
                    },
                    xaxis: {
                        convertedCatToNumeric: false,
                        categories: []
                    }
                },
                series: [{
                    name: 'Expenses Per Day',
                    data: []
                }]
            },
            expensesPerCategory: {
                chartOptions: {
                    chart: {
                        id: 'expensesPerCategory'
                    },
                    xaxis: {
                        categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998]
                    }
                },
                series: [{
                    name: 'Per Day',
                    data: [30, 40, 45, 50, 49, 60, 70, 91]
                },
                {
                    name: 'Per Project',
                    data: [30, 40, 45, 50, 49, 60, 70, 91]
                }]
            },
            chartOptions: {
                chart: {
                    id: 'app'
                },
                xaxis: {
                    categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998]
                }
            },
            series: [
            {
                name: 'series-1',
                data: [30, 40, 45, 50, 49, 60, 70, 91]
            },
            {
                name: 'series-2',
                data: [30, 40, 45, 50, 49, 60, 70, 91]
            },
            {
                name: 'series-3',
                data: [30, 40, 45, 50, 49, 60, 70, 91]
            }
            ]
        }
    },
}
</script>
