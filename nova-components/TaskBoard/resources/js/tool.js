import Tool from './components/Tool.vue';
import 'ant-design-vue/dist/antd.css';
import Antd from 'ant-design-vue';
Nova.booting((Vue, router, store) => {
Vue.use(Antd);
  router.addRoutes([
    {
      name: 'task-board',
      path: '/task-board',
      component: Tool,
    },
  ])
})
