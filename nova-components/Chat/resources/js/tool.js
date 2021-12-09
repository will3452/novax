import Tool from './components/Tool.vue';

Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'chat',
      path: '/chat',
      component: Tool,
    },
  ])
})
