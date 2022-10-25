<template>
    <card class="">
        <vue-final-modal v-model="modalShow" :esc-to-close="true" :hide-overlay="false" >
            <div class="h-screen w-screen flex justify-center p-4 items-center">
                <div class="bg-white p-4 px-8">
                    <label for="">Enter Amount</label>
                    <input type="number" min="1" v-model="amount" class="block border-2 form-control" placeholder="₱ 100.00">
                    <div class="mt-2">
                        <button class="btn btn-default btn-danger" @click="modalShow = false; amount = null">Cancel</button>
                        <button class="btn btn-default btn-primary" @click="submit">Load</button>
                    </div>
                </div>
            </div>
        </vue-final-modal>
        <div class="px-3 py-3">
            <h1 class="text-sm text-center">Current Balance</h1>
            <div class="text-center text-4xl mt-2">
                {{card.balance | formatCurrency}}
            </div>
            <div class="text-center mt-2">
                <button @click="modalShow = true" class="btn  btn-primary btn-default">
                    CASH IN
                </button>
            </div>
        </div>
    </card>
</template>

<script>
import axios from 'axios'

export default {
    props: [
        'card',
        // The following props are only available on resource detail cards...
        // 'resource',
        // 'resourceId',
        // 'resourceName',
    ],
    data () {
        return {
            axios,
            modalShow: false,
            amount: 0,
        }
    },
    methods: {
        async submit () {
            try {
                const data = await this.axios.post(this.card.postUrl, {amount: this.amount, user_id: this.card.userId})
                console.log(data)
                this.$toasted.success('Success');
            } catch (error) {
                this.$toasted.error('Error >> ' + error)
            }
        }
    },
    filters : {
        formatCurrency (data) {
            let formatting_options = {
                style: 'currency',
                currency: 'PHP',
                minimumFractionDigits: 2,
            }
            let formatter = new Intl.NumberFormat( 'en-US', formatting_options );
            return formatter.format(data)
        }
    },

    mounted() {
        //
    },
}
</script>
