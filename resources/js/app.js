/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import Antd from 'ant-design-vue';
import 'ant-design-vue/dist/antd.css';
import moment from 'moment'

window.moment = moment


window.Vue = require('vue').default;

// auth
Vue.component('login', require('./components/auth/login.vue').default);

//layout
Vue.component('layout', require('./components/layout/main.vue').default);
Vue.component('layout-content', require('./components/layout/content.vue').default);
Vue.component('layout-menu', require('./components/layout/menu.vue').default);

// Dashboard
Vue.component('dashboard-card', require('./components/dashboard/card.vue').default);
Vue.component('dashboard-calendar', require('./components/dashboard/calendar.vue').default);
Vue.component('dashboard-notices', require('./components/dashboard/notices.vue').default);

//booking
Vue.component('booking-card', require('./components/booking/card.vue').default);
Vue.component('booking-list', require('./components/booking/list.vue').default);

//notices
Vue.component('notice-list', require('./components/notices/list.vue').default)

//notifications
Vue.component('notifications', require('./components/notifications.vue').default)

// ticket
Vue.component('ticket-list', require('./components/ticket/list.vue').default)

// map
Vue.component('vue-map', require('./components/map.vue').default)

//qrCore reader
Vue.component('qr-code-reader', require('./components/qrReader.vue').default)

Vue.config.productionTip = false;
Vue.use(Antd);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
