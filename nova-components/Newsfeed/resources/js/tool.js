import Tool from './components/Tool.vue';
import Count from './components/Count.vue';
import OtherPage from './components/OtherPage.vue';

Nova.booting((Vue, router, store) => {
  Vue.component('Count', Count),
  router.addRoutes([
    {
        name: 'otherpage',
        path: '/newsfeed/otherpage',
        component: OtherPage,
    },
    {
      name: 'newsfeed',
      path: '/newsfeed',
      component: Tool,
    }
  ])
});
