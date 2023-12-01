<template>
    <div>
        <select name="" id="" class="mb-2" v-model="expensesDashboardFilter">
            <option value="day">Day</option>
            <option value="week">Week</option>
            <option value="month">Month</option>
            <option value="year">Year</option>
        </select>
        {{ incomes }}
        <div class="flex">
            <card class="p-4 mx-2">
                Total Expenses: <b>{{totalExpenses}}</b>
            </card>
            <card class="p-4 mx-2 ">
            Expenses Prediction Result: <b>{{predictions}}</b>
            </card>
            <card class="p-4 mx-2 ">
                Total Income: <b>{{ totalIncomes }}</b>
            </card>
        </div>
        <br/>
        <div class="flex">
            <ExpensesChartVue :data-sources="expensesWithPrediction"/>
            <IncomeChartVue :data-sources="incomes"/>
        </div>
        <div class="flex">
            <ProjectExpensesChartVue :data-sources="dataSources['projects']"/>
            <ExpensesPerCategoryChart :data-sources="categoryExpenses"/>
        </div>
    </div>
</template>

<script>
import VueApexCharts from 'vue-apexcharts'
import axios from 'axios';
import ExpensesChartVue from './ExpensesChart.vue';
import IncomeChartVue from './IncomeChart.vue';
import ProjectExpensesChartVue from './ProjectExpensesChart.vue'; 
import ExpensesPerCategoryChart from './ExpensesPerCategoryChart.vue';
import mixins from './mixin.js'; 
export default {
    name: 'Chart',
    mixins: [mixins], 
    components: {
        chart: VueApexCharts,
        ExpensesChartVue, 
        IncomeChartVue, 
        ProjectExpensesChartVue, 
        ExpensesPerCategoryChart, 
    },
    async mounted () {
        let data = await axios.get('/api/dashboard')
        console.log('data >> ', data.data)
        this.dataSources = {...data.data}
    }, 
    data() {
        return {
            dataSources: {}, 
            expensesDashboardFilter: 'day', 
        }
    },
    computed: {
        incomes() {
            try {
                return this.dataSources[`project_per_${this.expensesDashboardFilter}`].map((income => {
                    let expenses = this.expenses.find( e => e.label == income.label)
                    if (! expenses) return {...income}; 
                    console.log('expenses>> ', expenses)
                    return {label: income.label, value: income.value - expenses.value}
                }))
            } catch (error) {
                return [];
            }
        }, 
        expenses() {
            return this.dataSources[`expenses_per_${this.expensesDashboardFilter}`];
        }, 
        categoryExpenses() {
            return this.dataSources[`category_expenses_per_${this.expensesDashboardFilter}`];
        }, 
        expensesWithPrediction() {
            let result = [...this.expenses]; 
            result.push({label: this.expenses[this.expenses.length - 1].label + 1, value: this.predictions <= 0 ? 0 : this.predictions})
            return result; 
        },
        totalExpenses() {
            try {
                return this.expenses[this.expenses.length - 1].value <= 0 ? 0 : this.expenses[this.expenses.length - 1].value; 
            } catch (error) {
                return '---'; 
            }
        },
        totalIncomes() {
            try {
                return this.incomes[this.incomes.length - 1].value; 
            } catch (error) {
                return '---'; 
            }
        },
        predictions() {
            try {
                // Given expense data for 5 days
                const expenses = this.expenses.map( e => e.value); 
                const timeIndices = this.expenses.map( e => e.label); // Days as time indices
                // for (let i = this.expenses[0].label; i <= this.expenses[this.expenses.length - 1].label; i ++) {
                //     timeIndices.push(i); 
                //     expenses[expenses.length] = this.expenses.find( e => e.label == i) ? this.expenses.find( e => e.label == i).value : 0; 
                // }
                
                // Predicting expenses for future time indices 
                const futureTimeIndices = [timeIndices[timeIndices.length - 1] + 1];
                let result = this.predictFutureExpenses(timeIndices, expenses, futureTimeIndices)[0]; 
                console.table({expenses, timeIndices, futureTimeIndices})
                if (Number.isNaN(result)) return '---'
                return  result <= 0 ? 0 : result;
            } catch (error) {
                console.log(error)
                return '---'; 
            }
        }
    }, 
}
</script>
