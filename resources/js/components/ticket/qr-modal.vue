<template>
    <div>
        <a-modal title="QR code" :visible="visible" :closable="false" :centered="true" style="background: #fff !important;">
            <template slot="footer">
                <div>
                    <a-button @click="closeHandler">close</a-button>
                </div>
            </template>
            <vue-qr :text="getQrValue(ticket)"></vue-qr>
            <a-descriptions title="Ticket details" bordered size="small" :columns="1" style="background: #fff !important;">
                <a-descriptions-item label="Trip">
                    {{record.trip.start}} - {{record.trip.end}}
                </a-descriptions-item>
                <a-descriptions-item label="Seats">
                    {{record.seat}}
                </a-descriptions-item>
                <a-descriptions-item label="Date">
                    {{formatDate(record.date)}}
                </a-descriptions-item>
                <a-descriptions-item label="Amount Paid">
                    {{moneyFormat(record.amount_payable)}}
                </a-descriptions-item>
                <a-descriptions-item label="Bus No.">
                    {{record.bus.plate_number}}
                </a-descriptions-item>
            </a-descriptions>
        </a-modal>
    </div>
</template>

<script>
import vueQr from 'vue-qr-generator'
import { formatDate, moneyFormat } from '../../global.js'
export default {
    components: {vueQr},
    props: ['ticket', 'visible', 'record'],
    mounted() {
        this.show = this.visible
    },
    data() {
        return {
            show: false,
        }
    },
    methods: {
        formatDate,
        moneyFormat,
        getQrValue(item) {
            return "/tickets/" + item.id
        },
        closeHandler(item) {
            this.$emit('close')
        }
    }
}
</script>
