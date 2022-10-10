import Card from './components/Card.vue';
import VCalendar from 'v-calendar';
Nova.booting((Vue, router, store) => {
    Vue.use(VCalendar, {componentPrefix: 'vc'})
  Vue.component('calendar', Card)
})
