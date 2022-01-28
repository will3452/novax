require('./bootstrap.js')
import Vue from 'vue';
import TheInterest from './components/TheInterest.vue';

Vue.component('the-interest', TheInterest);
const app = new Vue({
}).$mount('#app')
