import component from './components/Tool.vue'; 
import VCalendar from 'v-calendar';
Nova.booting((Vue, router, store) => {
  Vue.use(VCalendar, {
    componentPrefix: 'vc',
  }); 
  router.addRoutes([
    {
      name: 'event-calendar',
      path: '/event-calendar',
      component,
    },
  ])
})
