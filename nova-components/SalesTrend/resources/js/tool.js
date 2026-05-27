Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'sales-trend',
      path: '/sales-trend',
      component: require('./components/Tool'),
    },
  ])
})
