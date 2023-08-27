import Tool from './components/Tool.vue';
import Lecture from './components/Lecture.vue';
import Room from './components/Room.vue';
Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'virtual-room',
      path: '/virtual-room',
      component: Tool,
    },
    {
        name: 'view-lecture',
        path: '/view-lecture',
        component: Room,
      },
      {
        name: 'lecture',
        path: '/lecture',
        component: Lecture,
      },
  ])
})
