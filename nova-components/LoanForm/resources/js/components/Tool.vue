<template>
    <div class="space-y-2">
        <heading class="mb-6">Create New Loan</heading>
        <div role="tablist" class="daisy-tabs daisy-tabs-lifted">
            <a role="tab" class="daisy-tab"
                @click="payload.type = 'individual'"
                :class="{'daisy-tab-active': payload.type == 'individual'}">Individual</a>
            <a role="tab" class="daisy-tab"
            @click="payload.type = 'group'"
            :class="{'daisy-tab-active': payload.type == 'group'}"
            >Group</a>
        </div>
        <div v-if="payload.type == 'individual'" >
            <div>
                <label for="" class="daisy-label">Select Borrower</label>
                <select placeholder="Select Borrower" v-model="payload.user_id" id="" class="daisy-select daisy-select-bordered w-full">
                    <option v-for="i in individual" :key="i.id" :value="i.id">
                        {{ i.name }} - {{ i.email }}
                    </option>
                </select>
            </div>
        </div>
        <div v-else>
            <div>
                <label for="" class="daisy-label">Select Group</label>
                <select placeholder="Select Group" v-model="payload.group_id" id="" class="daisy-select daisy-select-bordered w-full">
                    <option v-for="i in groups" :key="i.id" :value="i.id">
                        {{ i.name }}
                    </option>
                </select>
            </div>
        </div>
        <div>
            <label for="" class="daisy-label">
                Amount
            </label>
            <div class="daisy-input daisy-input-bordered flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 11H4m16-4H4m3 14V4a1 1 0 0 1 1-1h4a1 1 0 0 1 0 12H7"/></svg>
                <input type="number" class="grow" v-model="payload.amount" />
            </div>
        </div>
        <div>
            <label for="" class="daisy-label">
                Interest
            </label>
            <select placeholder="Select Borrower" v-model="payload.interest" id="" class="daisy-select daisy-select-bordered w-full">
                <option v-for="i in interests" :key="i.id" :value="i.rate">
                    {{ i.name }}
                </option>
            </select>
        </div>
        <div>
            <label for="" class="daisy-label">Number of installments</label>
            <input type="number" v-model="payload.number_of_installment" class="daisy-input-bordered daisy-input w-full">
        </div>
        <div>
            <label for="" class="daisy-label">
                Payment Schedule
            </label>
            <select placeholder="Select Borrower" v-model="payload.payment_schedule" id="" class="daisy-select daisy-select-bordered w-full">
                <option v-for="i in ['DAILY', 'WEEKLY', 'MONTHLY']" :key="i" :value="i">
                    {{ i }}
                </option>
            </select>
        </div>
        <div>
            <label for="" class="daisy-label">
                Collateral
            </label>
            <textarea name="" v-model="payload.collateral" class="daisy-textarea daisy-textarea-bordered w-full" id=""></textarea>
        </div>
        <div>
            <label for="" class="daisy-label">Collateral Image</label>
            <div >
                <input accept="image/*" type="file" @change="changeCollateralImage" class="daisy-file-input w-full max-w-xs" />
            </div>
        </div>
        <div>
            <label for="" class="daisy-label">Agreement Image</label>
            <div >
                <input accept="image/*" type="file" @change="changeAgreementImage" class="daisy-file-input w-full max-w-xs" />
            </div>
        </div>
        <div class="text-right">
            <button @click.prevent="submit" class="daisy-btn daisy-btn-secondary daisy-btn-lg text-white">Submit</button>
        </div>
    </div>
</template>

<script>
export default {
    metaInfo() {
        return {
          title: 'LoanForm',
        }
    },
    methods: {
        async submit () {
            try {
                let payload = {
                    ...this.payload,
                };
                let fd = new FormData()
                fd.append('data', JSON.stringify(payload))
                fd.append('agreement', this.agreement)
                fd.append('collateral', this.collateral)
                let { data } = await axios.post('/api/loan', fd);
                console.log('response ', data);
                alert('Loan has been created!');
                window.location.href = '/admin/resources/loans/' + data.id;
            } catch (error) {
                console.log(error.response.data);
                alert(error.response.data.error);
            }
        },
        changeCollateralImage(e) {
            if (e.target.files.length == 0) return;
            let file = e.target.files[0];
            this.collateral = file;
            console.log(file);
        },
        changeAgreementImage(e) {
            if (e.target.files.length == 0) return;
            let file = e.target.files[0];
            this.agreement = file;
            console.log(file);
        },
        async loadIndividuals () {
            try {
                let { data } = await axios.get('/nova-vendor/loan-form/boot')
                let {individual, interests, groups} = data;
                console.log('data ',  data)
                this.individual = individual.sort((a, b) => a.name.localeCompare(b.name));
                this.interests = interests;
                this.groups = groups;
            } catch (error) {
                alert('something went wrong')
            }
        }
    },
    data () {
        return {
            individual: [],
            groups: [],
            interests: [],
            collateral: null,
            agreement: null,
            payload: {
                type: 'individual',
            },
        }
    },
    mounted() {
        this.loadIndividuals()
    },
}
</script>

<style>
/* Scoped Styles */
</style>
