window.moment = require('moment');
window.axios = require('axios');
import Vue from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue';
import { LMap, LTileLayer, LMarker, LIcon } from 'vue2-leaflet';
import 'leaflet/dist/leaflet.css';
import Antd from 'ant-design-vue';
import 'ant-design-vue/dist/antd.css';
Vue.config.productionTip = false;

createInertiaApp({
  resolve: name => {
    const page = require(`./Pages/${name}`);
    return page;
  },
  setup({ el, App, props, plugin }) {
    Vue.use(plugin)
    Vue.use(Antd);
    Vue.component('l-map', LMap);
    Vue.component('l-tile-layer', LTileLayer);
    Vue.component('l-marker', LMarker);
    Vue.component('l-icon', LIcon);

    new Vue({
      render: h => h(App, props),
    }).$mount(el)
  },
})
