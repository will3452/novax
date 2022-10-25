import Card from './components/Card.vue';
import { vfmPlugin } from 'vue-final-modal'
import Toasted from 'vue-toasted'
Nova.booting((Vue, router, store) => {
    Vue.use(vfmPlugin);
    Vue.use(Toasted, {duration: 2000})
  Vue.component('current-balance', Card)
})
