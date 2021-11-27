
// Require Vue
window.Vue = require('vue').default;

// Register Vue Components
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('resume-uploader', require('./components/ResumeUploader.vue').default);
Vue.component('apply-button', require('./components/ApplyButton.vue').default);
// Initialize Vue
const app = new Vue({
    el: '#app',
});

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
