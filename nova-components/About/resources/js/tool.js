Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'about',
      path: '/about',
      component: require('./components/Tool'),
    },
  ])
})
