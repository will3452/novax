
// Require Vue
window.Vue = require('vue').default;
import Talk from 'talkjs';
window.axios = require("axios");

// Register Vue Components
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('resume-uploader', require('./components/ResumeUploader.vue').default);
Vue.component('apply-button', require('./components/ApplyButton.vue').default);
Vue.component('search-engine', require('./components/SearchEngine.vue').default);
Vue.component('notification-button', require('./components/NotificationButton.vue').default);
Vue.component('image-uploader', require('./components/ImageUploader.vue').default);
Vue.component('about-updater', require('./components/AboutUpdater.vue').default);
Vue.component('skills-adder', require('./components/SkillsAdder.vue').default);
Vue.component('chat-talk', require('./components/ChatTalk.vue').default);
Vue.component('message-icon', require('./components/MessageIcon.vue').default);
// Initialize Vue
const app = new Vue({
    el: '#app',
});
