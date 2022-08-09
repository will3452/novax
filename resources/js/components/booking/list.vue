<template>
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
                {{moneyFormat(fare)}} <span style="padding: 2px 4px; background: #eee; border-radius: 10px; font-size: 12px; text-decoration: line-through"> {{ moneyFormat(record.trip.fare) }} </span>
            </span>
        </template>
        <template slot="action" slot-scope="fare, record">
            <div>
                <a-button size="small" type="primary">Pay now</a-button>
                <a-button size="small" type="danger">Cancel</a-button>
            </div>
        </template>
    </a-table>
</template>
<script>
import { moneyFormat } from '../../global.js'
export default {
    props: ['userId'],
    async created () {
        try {
            this.loading = true
            let { data } = await window.axios.get('/api/booking?user='+this.userId)
            this.sourceData = data

            console.log("DATA >> ", data)
        } catch (error) {
            console.log('_created: error - ', error)
        } finally {
            this.loading = false
        }
    },
    data () {
        return {
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
    }

}
</script>
