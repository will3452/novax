import IndexField from './components/IndexField.vue';
import DetailField from './components/DetailField.vue';
import FormField from './components/FormField.vue';
Nova.booting((Vue, router, store) => {
  Vue.component('index-emo-field', IndexField);
  Vue.component('detail-emo-field', DetailField);
  Vue.component('form-emo-field', FormField);
})
