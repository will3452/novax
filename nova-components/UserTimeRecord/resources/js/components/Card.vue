<template>
    <card style="height:auto">
        <div class="px-3 py-3">
            {{selectedRecordId}}
            <div v-if="records.length">
                    <select name="" v-model="selectedRecordId" id="" @change="recordSelected()" class="
                        select-box-sm
                        ml-auto
                        min-w-24
                        h-6
                        text-xs
                        appearance-none
                        bg-40
                        pl-2
                        pr-6
                        active:outline-none active:shadow-outline
                        focus:outline-none focus:shadow-outline
                    ">
                    <option value="" disabled selected>---</option>
                    <option :value="record.record.id" v-for="record of records" v-key="record.id">
                        {{record.record.customer_control_number}}
                    </option>
                </select>
                <div class="mt-2 flex justify-between">
                    <div>
                        Role : {{position ? position:'---'}} <small v-if="main">(main PIC)</small>
                    </div>
                    <div>
                        Customer : {{customer ? customer:'---'}}
                    </div>
                </div>
                <div class="mt-2 flex justify-between">
                    <div>
                        Company Due Date : {{customer ? companyDueDate:'---'}}
                    </div>
                    <div>
                        Customer Due Date : {{customer ? customerDueDate:'---'}}
                    </div>
                </div>
                <div class="mt-2">
                    <input v-model="hour" type="number" class="w-full form-control form-input form-input-bordered" placeholder="Enter Work hour">
                </div>
                <div class="flex justify-between items-center" v-if="selectedRecordId">
                    <a :href="'/admin/resources/records/' + selectedRecordId" class="btn btn-light btn-default mt-2 block">View Details</a>
                    <button class="btn btn-primary btn-default mt-2 block" @click="submitWork">Submit Work Hour</button>
                </div>
            </div>
            <div v-if="!records.length">
                No Record Assigned
            </div>
        </div>
    </card>
</template>

<script>
export default {
    props: [
        'card',
        // The following props are only available on resource detail cards...
        // 'resource',
        // 'resourceId',
        // 'resourceName',
    ],

    data() {
        return {
            records:[],
            position: null,
            main: false,
            customer: null,
            companyDueDate:null,
            customerDueDate:null,
            selectedRecordId:null,
            hour:''
        };
    },

    mounted() {
        axios.get('/nova-vendor/user-time-record/get-records')
            .then(res=>{
                this.records = res.data.records;
                console.log(this.records)
            }).catch(err=>{
                alert('something went wrong');
            })
    },

    methods : {
        recordSelected() {
            this.records.forEach(data=>{
                if(data.id === this.selectedRecordId) {
                    this.position = data.position;
                    this.main = data.is_main;
                    this.customer = data.record.company_control_number;
                    this.customerDueDate = data.customer_due_date;
                    this.companyDueDate = data.company_due_date;
                }
            })
        },
        submitWork() {
            if(this.hour.length) {
                axios.post('/nova-vendor/user-time-record/submit-work-hour', {
                    'record_id' : this.selectedRecordId,
                    'hour' : this.hour,
                }).then(res=>{
                    alert('Success!');
                    console.log(res);
                    this.selectedRecordId = null;
                    this.hour = '';
                    this.position = null;
                    this.main = null;
                    this.customer = null;
                    this.customerDueDate = null;
                    this.companyDueDate = null;
                })
            }
        }
    },
}
</script>
