<template>
    <div>
        <a-table :columns="columns" :loading="loading" :data-source="sourceData">
            <template slot="date" slot-scope="item">
                <span>
                    {{getDate(item)}}
                </span>
            </template>
            <template slot="trip" slot-scope="trip, record">
                <span>
                    {{ trip.start }} - {{trip.end}}
                </span>
            </template>
            <template slot="discount" slot-scope="discount, record">
                <span>
                    {{record.discount ? record.discount.rate + '%': '-'}}
                </span>
            </template>
            <template slot="fare" slot-scope="fare, record">
                <span>
                    {{moneyFormat(fare)}} <span v-if="record.discount" style="padding: 2px 4px; background: #eee; border-radius: 10px; font-size: 12px; text-decoration: line-through"> {{ moneyFormat(record.trip.fare) }} </span>
                </span>
            </template>
            <template slot="action" slot-scope="fare, record">
                <div>
                    <a-button size="small" type="primary" v-if="record.status === 'TO PAY' " @click="payNow(record)">Pay now</a-button>
                    <a-button size="small" type="danger" v-if="record.status === 'FOR REVIEW' " @click="cancelNow(record)">Cancel</a-button>
                    <a-button size="small" disabled type="danger" v-if="record.status === 'CANCELLED' " @click="cancelNow(record)">Cancel</a-button>
                </div>
            </template>
        </a-table>
        <paymodal :customer="user" :visible="paymodalShow" :amount-payable="amountPayable" :description="description" :record-type="recordType" :record-id="recordId"></paymodal>
    </div>
</template>
<script>
import { moneyFormat } from '../../global.js'
import paymodal from '../utils/paymodal.vue'
export default {
    props: ['userId'],
    components: {
        paymodal,
    },
    async created () {
        try {
            this.loading = true
            let { data } = await window.axios.get('/api/booking?user='+this.userId)
            this.sourceData = data
            let userResponse = await window.axios.get('/api/get-user-details?user=' + this.userId)
            this.user = userResponse.data
        } catch (error) {
            console.log('_created: error - ', error)
        } finally {
            this.loading = false
        }
    },
    data () {
        return {
            user: null,
            amountPayable: 0,
            recordId:0,
            recordType: null,
            description: '',
            paymodalShow: false,
            loading: true,
            sourceData: [],
            columns: [
                {
                    dataIndex: 'date',
                    title: 'Date',
                    scopedSlots: {customRender: 'date'}
                },
                {
                    dataIndex: 'status',
                    title: 'Status',
                },
                {
                    dataIndex: 'trip',
                    title: 'Trip',
                    scopedSlots: {customRender: 'trip'}
                },
                {
                    dataIndex: 'trip',
                    title: 'Discount',
                    scopedSlots: {customRender: 'discount'}
                },
                {
                    dataIndex: 'amount_payable',
                    title: 'Fare',
                    scopedSlots: {customRender: 'fare'}
                },
                {dataIndex: 'created_at', key: 'action', title: 'Action', scopedSlots: {customRender: 'action'}},
            ]
        }
    },
    methods: {
        moneyFormat,
        getDate(item) {
            return window.moment(item).format('MMM Do YY')
        },
        cancelNow({ id }, confirm = false) {

            if (! confirm) {
                this.$confirm({
                    title: 'Cancel Confirmation',
                    content: 'Are you sure you want to cancel ?',
                    onOk: async () => {
                       try {
                             await window.axios.post('/bookings/cancel', {booking_id: id})
                             this.$notification.success({message: 'Success', description: 'Cancelled Successfully.'})
                       } catch (err) {
                            this.$notification.error({message: 'Error', description: err.message})
                       }
                    }
                })
            }
        },
        payNow( {amount_payable, id} ) {
            this.recordId = id
            this.recordType = '\\App\\Models\\Booking'
            this.amountPayable = amount_payable
            this.description = `pay book with id of ${id}`;
            this.paymodalShow = true
        }
    }

}
</script>
