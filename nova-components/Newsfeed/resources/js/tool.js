import Tool from './components/Tool.vue';
import Count from './components/Count.vue';

Nova.booting((Vue, router, store) => {
  Vue.component('Count', Count),
  router.addRoutes([
    {
      name: 'newsfeed',
      path: '/newsfeed',
      component: Tool,
    },
  ])
});
