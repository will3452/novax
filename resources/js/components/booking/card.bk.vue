<template>
    <dashboard-card
        style="margin-right:1em;background-image: linear-gradient(to bottom, #3BC062 , #2DB15A);color:white; border: none;border-radius: 1em;"
        icon="pushpin"
        label="Booking"
        >
            <a-button type="ghost" block @click="viewForm" >
                Book Now
            </a-button>
            <!-- <a-drawer title="Booking Form" placement="bottom" :height="500" :visible="bookingFormVisible" @close="closeHandler">
            <errors :errors="errors"></errors>
            <a-form-model v-if="!loading" :model="payload">

                <a-row>
                    <a-col :span="4">
                        <a-form-model-item label="Select"  prop="is_group">
                            <a-radio-group v-model="isGroup" style="width: 100%" :default-value="isGroup" button-style="solid">
                                <a-radio-button :value="0">
                                    Individual
                                </a-radio-button>
                                <a-radio-button :value="1">
                                    Group
                                </a-radio-button>
                            </a-radio-group>
                        </a-form-model-item>
                    </a-col>
                    <a-col :span="20">
                        <a-form-model-item label="Select Trip" required prop="trip" >
                            <a-select v-model="payload.trip" allow-clear>
                                <a-select-option :key="trip" :value="trip.id" v-for="trip in trips">
                                    <div>
                                        {{trip.start}} - {{trip.end}}
                                    </div>
                                </a-select-option>
                            </a-select>

                        </a-form-model-item>
                    </a-col>
                </a-row>
                <a-row :gutter="12">
                    <a-col :span="12">
                        <a-form-model-item label="Date" prop="date" required>
                            <a-date-picker v-model="payload.date" :disabled-date="disabledDate" style="width:100%"></a-date-picker>
                        </a-form-model-item>
                    </a-col>
                    <a-col :span="12">
                        <a-form-model-item label="Time" prop="time_id" required>
                            <a-select v-model="payload.time_id">
                                <a-select-option v-for="time in times" :value="time.id" :key="time.id">
                                    {{moment(time.time).format('hh:mm a')}}
                                </a-select-option>
                            </a-select>
                        </a-form-model-item>
                    </a-col>
                </a-row>

                <a-row v-if="isGroup" :gutter="[12, 12]">
                    <a-col :span="24">
                        <a-button type="primary" @click="addMember">
                            <a-icon type="user-add" /> Add member
                        </a-button>
                    </a-col>
                    <a-col :span="24" v-if="members.length">
                        <a-card size="small" title="Member(s) setting" >
                            <a-row :gutter="12" v-for="member, index in members" :key="index">
                                <a-col :span="12">
                                    <a-form-model-item  :label="`Member ${index + 1} type`">
                                        <a-select v-model="members[index].type">
                                            <a-select-option v-for="item in typeOfPassengers" :key="item" :value="item">
                                                {{item}}
                                            </a-select-option>
                                        </a-select>
                                    </a-form-model-item>
                                </a-col>
                                <a-col :span="12">
                                    <a-form-model-item  :label="`Member ${index + 1} Seat`">
                                        <a-select v-model="members[index].seat">
                                            <a-select-option v-for="item in typeOfPassengers" :key="item" :value="item">
                                                {{item}}
                                            </a-select-option>
                                        </a-select>
                                    </a-form-model-item>
                                </a-col>
                            </a-row>
                        </a-card>
                    </a-col>
                </a-row>

                <!-- <a-form-model-item label="Discount" prop="discount_id">
                    <a-select v-model="payload.discount_id" allow-clear>
                        <a-select-option :key="discount.id" :value="discount.id" v-for="discount in discounts">
                            <span>
                                {{discount.description}} - {{discount.rate}} %
                            </span>
                        </a-select-option>
                    </a-select>
                </a-form-model-item>
                <div v-if="payload.discount_id">
                    <uploader @uploaded="uploadedHandler">
                        Upload the picture of your supporting docs, or ID.
                    </uploader>
                </div> -->
                <a-alert v-if="getRemarks(payload.trip)" type="info" message="Other Info." :description="getRemarks(payload.trip)"></a-alert>
                <a-descriptions style="margin-top: 1em;">
                    <a-descriptions-item label="Fare">
                        <span style="font-size:32px">{{totalFare || '0.00'}}</span>
                    </a-descriptions-item>
                </a-descriptions>
                <a-button type="primary" size="large" :loading="loadingSubmit" @click="submit" block>Book now</a-button>
                <a-alert style="margin-top: 1em;" type="warning" show-icon description="Your booking request is still required to be reviewed for admin approval."></a-alert>
            </a-form-model>
            <a-skeleton v-else></a-skeleton>
        </a-drawer> -->
        </dashboard-card>
</template>

<script>
import { moneyFormat, deepCopy } from '../../global.js'
import moment from 'moment'
import uploader from '../utils/uploader.vue'
import errors from '../utils/errors.vue';
export default {
    props:['userId'],
    components: {
        uploader,
        errors,
    },
    async created () {
        await this.loadDiscounts()
        await this.loadTimes()
    },
    data () {
        return {
            typeOfPassengers: [
                'kids',
                'adult',
            ],
            members:[],
            isGroup: 0,
            errors: [],
            discounts: [],
            loading: true,
            loadingSubmit: false,
            bookingFormVisible: false,
            trips: [],
            times:[],
            payload: {},
        }
    },
    computed: {
        totalFare() {
            return this.formatNumber(this.getAbsoluteFare(this.payload.trip) - this.getDiscount())
        },
    },
    methods: {
        moment,
        deepCopy,
        uploadedHandler(file) {
            this.payload.discount_image_proof = file
        },
        addMember () {
            this.members.push({})
        },
        async submit() {
            try {
                this.loadingSubmit = true
                this.payload.amount_payable = (this.getAbsoluteFare(this.payload.trip) - this.getDiscount())
                let tripId = this.payload.trip
                this.payload.trip_id = tripId
                this.payload.user_id = this.deepCopy(this.userId)
                await window.axios.post('/api/booking', { ...this.payload })
                this.$notification.success({message:'Success', description: 'Booked successfully!'})
                this.bookingFormVisible = false
            } catch(err) {
                let { response } = err
                if (response.status == 422) {
                    this.errors = Object.values(response.data.errors)
                } else {
                    this.$notification.error({message:'Error', description: err.message})
                }
            } finally {
                this.loadingSubmit = false
                this.payload = {}
                this.errors = []
            }
        },
        disabledDate(current) {
            return current && current < moment().endOf('day');
        },
        getTripDetails(tripId) {
            return this.trips.find( e => e.id == tripId)
        },
        getRemarks(tripId) {
            let trip =  this.getTripDetails(tripId)
            return trip ? trip.remarks : false
        },
        getAbsoluteFare(tripId) {
            let trip = this.getTripDetails(tripId)
            let fare = 0
            if (trip) {
                fare = trip.fare
            }
            return fare
        },
        getDiscount() {
            if (! this.payload.discount_id) {
                return 0
            }
            let discount = this.discounts.find( e => e.id == this.payload.discount_id)
            if (discount && this.payload.trip) {
                return (discount.rate / 100) * this.getTripDetails(this.payload.trip).fare
            }
            return 0
        },
        formatNumber(fare) {
            return moneyFormat(fare)
        },
        getFare(tripId) {
            let fare = (this.getAbsoluteFare(tripId) - this.getDiscount())
            return this.formatNumber(fare)
        },
        async viewForm() {
            this.bookingFormVisible = true
            await this.loadTrips()
        },
        closeHandler () {
            this.payload = {}
            this.bookingFormVisible = false
        },
        async loadDiscounts () {
            try {
                this.loading =  true
                let { data } = await window.axios.get('/api/discounts')
                this.discounts = data
            } catch (err) {
                console.log('Discount error >> ', err)
            } finally {
                this.loading = false
            }
        },
        async loadTimes() {
            try {
                this.loading = true
                let { data } = await window.axios.get('/api/times')
                this.times = data
            } catch (err) {
                this.$notification.error({message:'Error', description: 'Failed to load trips.'})
            } finally {
                this.loading = false
            }
        },
        async loadTrips() {
            try {
                this.loading = true
                let { data } = await window.axios.get('/api/trips')
                this.trips = data
            } catch (err) {
                this.$notification.error({message:'Error', description: 'Failed to load trips.'})
            } finally {
                this.loading = false
            }
        },
    }
}
</script>
