<template>
    <div>
        <a-modal v-model="visible" title="Payment option" :footer="null">
            <a-button @click="submit" :loading="gcashButtonLoading">Pay with Gcash</a-button>
        </a-modal>
    </div>
</template>

<script>
import axios from 'axios'
import { loadScript } from '@paypal/paypal-js'
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
    mounted: function() {
        const script = document.createElement("script");
        script.src =
        "https://www.paypal.com/sdk/js?client-id=ARv4l18z2mbrbhTZSXSBYkwm-FB6B_JsqnxjLPx4YucjAWXJyTYiZ0piB1Tst7HfDtMtowx5zajuOatI";
        script.addEventListener("load", this.setLoaded);
        document.body.appendChild(script);
    },
    methods: {
        setLoaded: function() {
            window.paypal
                .Buttons({
                createOrder: (data, actions) => {
                    return actions.order.create({
                    purchase_units: [
                        {
                        description: this.product.description,
                        amount: {
                            currency_code: "PHP",
                            value: 100
                        }
                        }
                    ]
                    });
                },
                onApprove: async (data, actions) => {
                    const order = await actions.order.capture();
                    console.log(order);
                },
                onError: err => {
                    console.log(err);
                }
                })
                .render(this.$refs.paypal);
            },
        loadScript,
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
