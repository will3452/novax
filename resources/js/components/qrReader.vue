<template>
    <div>
        <a-spin :spinning="loading"></a-spin>
        <!-- <p>Result : <code>{{result}}</code></p> -->
        <no-ssr>
            <qr-reader @code-scanned="showResult"></qr-reader>
            <div  v-if="responseResult" style="background: #fff; !important;">
                <a-descriptions :bordered="true" :column="1" size="small">
                    <a-descriptions-item label="Status">
                        {{responseResult.used ? 'Used.' : 'Not used.'}}
                    </a-descriptions-item>
                    <a-descriptions-item label="Booked Date">
                        {{formatDate(responseResult.booking.date)}}
                    </a-descriptions-item>
                    <a-descriptions-item label="Amount paid">
                        {{moneyFormat(responseResult.booking.amount_payable || 0)}}
                    </a-descriptions-item>
                    <a-descriptions-item label="Paid Date">
                        {{formatDate(responseResult.booking.paid_at)}}
                    </a-descriptions-item>
                    <a-descriptions-item label="Discount">
                        {{ responseResult.booking.discount ? responseResult.booking.discount.rate + '%' : '-' }}
                    </a-descriptions-item>
                    <a-descriptions-item label="Trip">
                        {{ responseResult.booking.trip.start + ' - ' +  responseResult.booking.trip.end }}
                    </a-descriptions-item>

                </a-descriptions>
                <a-button :loading="loading" type="primary" style="margin-top: 1em;" @click="useSubmit" v-if="responseResult.used === 0"> Use </a-button>
                <a-button v-else disabled type="primary" style="margin-top: 1em;" @click="useSubmit"> Use </a-button>
            </div>
        </no-ssr>
    </div>
</template>

<script>
import qrReader from 'vue-qr-reader/dist/lib/vue-qr-reader.umd.js'
import noSsr from 'vue-no-ssr'
import { formatDate, moneyFormat } from '../global.js'
export default {
    components: {
        qrReader,
        noSsr,
    },
    data () {
        return {
            result: '',
            loading: false,
            responseResult: null
        }
    },
    methods: {
        formatDate,
        moneyFormat,
        async useSubmit() {
            try {
                this.loading = true
                let response = await window.axios.post('/tickets/' + this.responseResult.id)
                console.log('use response >> ', response )
                this.$message.success('Ticket used!')
                window.location.reload()
            } catch (err) {
                this.$message.error('Something went wrong.')
                console.log('response error >> ', err)
            } finally {
                this.loading = false
            }
        },
        showResult(data) {
            this.result = data
            console.log("RESULT >> ", data)
            this.getDetails()
        },
        async getDetails () {
            try {
                this.loading = true
                let response = await window.axios.get(this.result)
                console.log("response >> ", response)
                let { data } = response
                this.responseResult = data
            } catch (err) {
                this.$message.error('Something went wrong.')
                console.log('response error >> ', err)
            } finally {
                this.loading = false
            }
        }
    }
}
</script>
