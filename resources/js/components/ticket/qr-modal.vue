<template>
    <div>
        <a-modal title="QR code" :visible="visible" :closable="false" :centered="true">
            <template slot="footer">
                <div>
                    <a-button @click="closeHandler">close</a-button>
                </div>
            </template>
            <vue-qr :text="getQrValue(ticket)"></vue-qr>
        </a-modal>
    </div>
</template>

<script>
import vueQr from 'vue-qr-generator'
export default {
    components: {vueQr},
    props: ['ticket', 'visible'],
    mounted() {
        this.show = this.visible
    },
    data() {
        return {
            show: false,
        }
    },
    methods: {
        getQrValue(item) {
            return "https://bus.projet.space/tickets/" + item.id
        },
        closeHandler(item) {
            this.$emit('close')
        }
    }
}
</script>
