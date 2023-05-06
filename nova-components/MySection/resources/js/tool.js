Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'my-section',
      path: '/my-section',
      component: require('./components/Tool'),
    },
  ])
})
