import Tool from './components/Tool.vue'
import Toasted from 'vue-toasted'
import VueChatScroll from 'vue-chat-scroll'
Nova.booting((Vue, router, store) => {
 Vue.use(Toasted, {duration: 1000, position: 'top-center'})
 Vue.use(VueChatScroll)
  router.addRoutes([
    {
      name: 'chat',
      path: '/chat',
      component: Tool,
    },
  ])
})
