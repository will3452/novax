import Vue from 'vue';
import axios from 'axios';

import FileUploader from './components/FileUploader.vue';

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.Vue = Vue;

Vue.component('file-uploader', FileUploader);

new Vue({
    el: '#app',
})
