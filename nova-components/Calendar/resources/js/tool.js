import Tool from './components/Tool.vue';
import VCalendar from 'v-calendar';
Nova.booting((Vue, router, store) => {
  Vue.use(VCalendar, {
    componentPrefix: 'vc',
  })
  router.addRoutes([
    {
      name: 'calendar',
      path: '/calendar',
      component: Tool,
    },
  ])
})
