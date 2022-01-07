import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import Layout from './Shared/Layout.vue';
import { InertiaProgress } from '@inertiajs/progress'

createInertiaApp({
  title: title=> `${title} | Lapito`,
  resolve: name => {
    const page = require(`./Pages/${name}`).default
    page.layout = page.layout || Layout
    return page;
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .component('goto-top', require('./Shared/GotoTop.vue').default)
      .component('Link', require('@inertiajs/inertia-vue3').Link)
      .component('Head', require('@inertiajs/inertia-vue3').Head)
      .use(plugin)
      .mount(el)
  },
})

InertiaProgress.init({
    color:'rgb(120 53 15)'
});
