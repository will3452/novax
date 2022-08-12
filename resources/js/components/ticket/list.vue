<template>
    <a-card :loading="loading" title="tickets">
        <a-tabs default-active-key="1">
            <a-tab-pane key="1" tab="Not yet used.">
                <a-list :data-source="tickets" bordered>
                    <a-list-item slot="renderItem" slot-scope="item, index">
                        <a href="#" slot="actions" @click="showQr(item)">
                            <a-icon type="qrcode" />
                        </a>
                        <a-list-item-meta :description="item.booking.trip.start + ' - ' + item.booking.trip.end + ' | ' + formatDate(item.booking.date)">
                            <a href="#" slot="title">Ref# - {{getData(item, 'reference')}}</a>
                        </a-list-item-meta>
                    </a-list-item>
                </a-list>
            </a-tab-pane>
            <a-tab-pane key="2" tab="Already used.">
                <a-list :data-source="tickets" bordered>
                    <a-list-item slot="renderItem" slot-scope="item, index">
                        <!-- <a href="#" slot="actions">
                            <a-icon type="qrcode" />
                        </a> -->
                        <a-list-item-meta :description="item.booking.trip.start + ' - ' + item.booking.trip.end + ' | ' + formatDate(item.booking.created_at)">
                            <a href="#" slot="title">Ref# - {{getData(item, 'reference')}}</a>
                        </a-list-item-meta>
                    </a-list-item>
                </a-list>
            </a-tab-pane>
        </a-tabs>
        <qr-modal :visible="qrShow" :ticket="ticket" @close="qrShow = false"></qr-modal>
    </a-card>
</template>

<script>
import qrModal from './qr-modal.vue'
import { formatDate } from '../../global.js'
    export default {
        components: {
            qrModal,
        },
        async mounted () {
            try {
                let { data } = await window.axios.get('/tickets/me')
                this.tickets = data
            } catch (err) {
                this.$notification.error({message: 'Error', description: 'Something went wrong contact the administrator.'})
            } finally {
                this.loading = false
            }
        },
        methods: {
            formatDate,
            getData ({ data }, key) {
                return JSON.parse(data)[key]
            },
            showQr (record) {
                this.qrShow = true
                this.ticket = record
            }
        },
        data() {
            return {
                qrShow: false,
                tickets: [],
                ticket: {},
                loading: true,
            }
        }
    }
</script>
