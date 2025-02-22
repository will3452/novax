import Tool from './components/Tool.vue'
Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'loan-form',
      path: '/loan-form',
      component: Tool,
    },
  ])
})
