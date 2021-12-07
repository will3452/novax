Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'newsfeed',
      path: '/newsfeed',
      component: require('./components/Tool'),
    },
  ])
})
