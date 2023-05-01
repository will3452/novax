Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'import-and-export',
      path: '/import-and-export',
      component: require('./components/Tool'),
    },
  ])
})
