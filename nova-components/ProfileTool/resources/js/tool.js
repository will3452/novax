import Tool from './components/Tool';

import axios from 'axios';

window.axios = axios;

Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'profile-tool',
      path: '/profile-tool',
      component: Tool,
    },
  ])
})
