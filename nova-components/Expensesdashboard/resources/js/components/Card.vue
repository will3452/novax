<template>
    <div>
        <div class="flex items-center">
            <select class="p-2  border-2 border-green-700rounded mb-2 px-4" name="" id=""  v-model="expensesDashboardFilter">
                <option value="day">Day</option>
                <option value="week">Week</option>
                <option value="month">Month</option>
                <option value="year">Year</option>
            </select>
        </div>
        <div class="flex justify-center">
            <card class="p-4 m-2 w-full md:w-1/3 text-center">
                <h1>{{ totalExpenses | format }}</h1>
                <div>
                    Total Expenses
                </div>
            </card>
            <card class="p-4 m-2 w-full md:w-1/3 text-center">
                <h1>{{ predictions  | format}}</h1>
                <div>
                    Expenses Prediction Result after a {{ expensesDashboardFilter }}
                </div>
            </card>
            <card class="p-4 m-2 w-full md:w-1/3 text-center ">
                <h1>{{ totalIncomes | format}}</h1>
                <div>
                    Total Income
                </div>
            </card>
        </div>
        <br/>
        <div class="flex justify-center">
            <div class="w-full md:w-1/2">
                <ExpensesChartVue :key="key" :data-sources="expensesWithPrediction"/>
            </div>
            <div class="w-full md:w-1/2">
                <IncomeChartVue :data-sources="incomes"/>
            </div>
        </div>
        <div class="flex justify-center">
            
            <div class="w-full md:w-1/2">
                <ProjectExpensesChartVue :data-sources="projectBudgets"/>
            </div>
            <div class="w-full md:w-1/2">
                <ExpensesPerCategoryChart :data-sources="categoryExpenses"/>
            </div>
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
            key: 0, 
            dataSources: {}, 
            expensesDashboardFilter: 'day', 
        }
    },
    watch: {
        expensesDashboardFilter(current, old){
            this.key ++; 
        }
    }, 
    computed: {
        projectBudgets() {
            return this.dataSources[`project_per_${this.expensesDashboardFilter}`]; 
        },
        incomes() {
            try {
                return this.projectBudgets.map((income => {
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
            try {
                let result = [...this.expenses]; 
                let label = this.expenses[this.expenses.length - 1].label; 
                if (label > 12 && this.expensesDashboardFilter == 'month') {
                    label = (label + 1) % 12; 
                } else if (label <= 11) {
                    label += 1; 
                } 
                result.push({label, value: this.predictions <= 0 ? 0 : this.predictions})
                return result.map(e => ({...e, value: (e.value || 0).toFixed(2)})); 
            } catch (error) {
                console.log(error)
                return []
            }
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
                if (Number.isNaN(result)) return expenses[expenses.length - 1];
                return  result <= 0 ? 0 : result;
            } catch (error) {
                console.log(error)
                return 0; 
            }
        }
    }, 
}
</script>
