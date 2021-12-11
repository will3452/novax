import Card from './components/Card.vue';
import axios from 'axios';

window.axios = axios;

Nova.booting((Vue, router, store) => {
  Vue.component('user-time-record', Card)
});
