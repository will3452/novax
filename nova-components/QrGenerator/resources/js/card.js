import Card from './components/Card.vue'
import VueQRCodeComponent from 'vue-qr-generator'
import { QrcodeStream } from 'vue-qrcode-reader'
import { vfmPlugin } from 'vue-final-modal'
import Toasted from 'vue-toasted'

Nova.booting((Vue, router, store) => {

    Vue.use(vfmPlugin)

    Vue.use(Toasted, {duration: 2000})
  Vue.component('qr-code', VueQRCodeComponent)
  Vue.component('qr-code-stream', QrcodeStream)
  Vue.component('qr-generator', Card)
})
