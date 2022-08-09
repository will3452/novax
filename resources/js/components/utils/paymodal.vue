<template>
    <div>
        <a-modal v-model="visible" title="Payment option" :footer="null">
            <a-button @click="submit" :loading="gcashButtonLoading">Pay with Gcash</a-button>
        </a-modal>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    props: ['visible', 'amountPayable', 'description', 'customer', 'recordType', 'recordId'],
    data () {
        return {
            gcashButtonLoading: false,
        }
    },
    async created() {
        let { data } = await axios.get('/api/pkey')
    },
    methods: {
        async submit () {
            try {
                this.gcashButtonLoading = true
                let { data } = await window.axios.post('/pay', { amount: this.amountPayable, description: this.description, customername: this.customer.name, customeremail: this.customer.email, customermobile: this.customer.mobile, redirectsuccessurl: 'http://localhost:8000/payment-success'}) // TODO payment success url
                let { checkouturl, request_id } = data.data

                // create transactions
                let payload = {
                    model_id: this.recordId,
                    model_type: this.recordType,
                    hash: request_id,
                }

                await axios.post('/api/transaction', payload)

                window.open(checkouturl, '_blank')
            } catch (err) {
                console.log(err)
            } finally {
                this.gcashButtonLoading = false
            }
        }
    }
}
</script>
