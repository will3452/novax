import Tool from './components/Tool.vue';
import ViewSection from './views/ViewSection.vue';
import JsonExcel from "vue-json-excel";

import 'ant-design-vue/dist/antd.css';
import Antd from 'ant-design-vue';
Nova.booting((Vue, router, store) => {
    Vue.component('downloadExcel', JsonExcel);
    Vue.use(Antd);
  router.addRoutes([
    {
      name: 'sections',
      path: '/sections',
      component: Tool,
    },
    {
        name: 'view-section',
        path: '/section/:loadId',
        component: ViewSection,
    }
  ])
})
