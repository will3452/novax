import Tool from './components/Tool.vue';
Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'booking-calendar',
      path: '/booking-calendar',
      component: Tool,
    },
  ])
})
