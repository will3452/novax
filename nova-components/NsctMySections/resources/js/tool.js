Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'nsct-my-sections',
      path: '/nsct-my-sections',
      component: require('./components/Tool'),
    },
  ])
})
