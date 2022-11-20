<template>
    <dashboard-card
        style="margin-right:1em;background-image: linear-gradient(to bottom, #3BC062 , #2DB15A);color:white; border: none;border-radius: 1em;"
        icon="pushpin"
        label="Booking"
        >
            <a-button type="ghost" block @click="viewForm" >
                Book Now
            </a-button>
            <a-drawer title="Booking Form" placement="top" :height="500" :visible="bookingFormVisible" @close="closeHandler">
            <errors :errors="errors"></errors>
            <a-form-model v-if="!loading" :model="payload">
                <a-row type="flex" justify="center" v-if="step == 0">
                    <a-button type="primary" @click="setGroup(0)" style="margin: 1em;" size="large" >INDIVIDUAL</a-button>
                    <a-button type="primary" @click="setGroup(1)" style="margin: 1em;" size="large">GROUP</a-button>
                </a-row>

                <a-div v-if="step == 1">
                    <a-form-model-item label="Select Trip" required prop="trip">
                        <a-select v-model="payload.trip">
                            <a-select-option :key="'trip123' + trip.id" :value="trip.id" v-for="trip in trips">
                                <div>
                                    {{trip.start}} - {{trip.end}}
                                </div>
                            </a-select-option>
                        </a-select>
                    </a-form-model-item>
                    <a-form-model-item label="Date" prop="date" required>
                        <a-date-picker v-model="payload.date" :disabled-date="disabledDate" style="width:100%"></a-date-picker>
                    </a-form-model-item>
                    <a-form-model-item label="Time" prop="time" required>
                        <a-select v-model="payload.time">
                            <a-select-option v-for="time in times" :value="time.id" :key="'to123' + time.id">
                                {{moment(time.time).format('hh:mm a')}}
                            </a-select-option>
                        </a-select>
                    </a-form-model-item>
                    <a-button size="large" type="primary" @click="fetchBus" :disabled="!(payload.time && payload.date && payload.trip)">
                        PROCEED
                    </a-button>
                </a-div>

                <div v-if="step == 2">
                    <a-result v-if="! bus" status="404" title="No Bus Available."></a-result>
                    <div v-else>
                        <a-row type="flex" justify="center">
                            <img style="max-height: 300px;" :src="`/storage/${bus.seat_image}`" alt="seat"/>
                        </a-row>
                    </div>
                    <a-row type="flex" justify="center">
                        <a-col :span="24">
                            <a-descriptions  bordered size="small" :column="1">
                                <a-descriptions-item label="Plate No.">
                                    {{bus.plate_number}}
                                </a-descriptions-item>
                                <a-descriptions-item label="Capacity">
                                    {{bus.capacity}}
                                </a-descriptions-item>
                            </a-descriptions>
                            <div v-if="! isGroup">
                                <a-form-model-item label="Select type of passenger" required prop="type">
                                    <a-select v-model="payload.type">
                                        <a-select-option v-for="item in typeOfPassengers" :key="'reds' + item" :value="item">
                                            {{item}}
                                        </a-select-option>
                                    </a-select>
                                </a-form-model-item>
                                <a-form-model-item label="Select preferred seat" required prop="seat">
                                    <a-select v-model="payload.seat">
                                        <a-select-option v-for="i in parseInt(bus.capacity)" :key="'cap' + i" :value="i" :disabled="notAvailable.includes(`${i}`)">
                                            {{i}}
                                        </a-select-option>
                                    </a-select>
                                </a-form-model-item>
                                <a-button size="large" :disabled="! (payload.seat && payload.type)" type="primary" @click="review">
                                    PROCEED
                                </a-button>
                            </div>
                            <div v-else>
                                <a-form-model-item>
                                    <a-button type="primary" @click="addMember">
                                        ADD MEMBER
                                    </a-button>
                                </a-form-model-item>
                                <a-card title="Members setting" size="small">
                                    <div v-for="member, index in members" :key="'member' + index">
                                        <a-divider>Member {{index + 1}}</a-divider>
                                        <a-row :gutter="[12, 12]" >
                                        <a-col :span='12'>
                                            <a-form-model-item label="Type">
                                                <a-select   v-model="members[index].type">
                                                    <a-select-option v-for="item in typeOfPassengers" :key="'red' + item" :value="item">
                                                        {{item}}
                                                    </a-select-option>
                                                </a-select>
                                            </a-form-model-item>
                                        </a-col>
                                        <a-col :span='12'>
                                            <a-form-model-item label="Seat"  >
                                                <a-select  v-model="members[index].seat">
                                                    <a-select-option v-for="i in parseInt(bus.capacity)" :key="'capasd' + i" :value="i" :disabled="notAvailable.includes(`${i}`)">
                                                        {{i}}
                                                    </a-select-option>
                                                </a-select>
                                            </a-form-model-item>
                                        </a-col>
                                    </a-row>

                                    </div>
                                </a-card>
                                <a-button size="large" :disabled="! (members.length > 1 && members.some( x => ! (x.seat  == null || x.type == null)))" type="primary" @click="review">
                                    PROCEED
                                </a-button>
                            </div>
                        </a-col>
                    </a-row>
                </div>

                <div v-if="step == 3">
                    <a-descriptions :column="1" title="Summary" size="small" bordered>
                        <a-descriptions-item label="Trip">
                            <!-- {{trip.start}} - {{trip.end}} -->
                            <div>
                                {{getTripSumarry}}
                            </div>
                        </a-descriptions-item>
                        <a-descriptions-item label="Date">
                            {{moment(payload.date).format('YYYY-MM-DD')}}
                        </a-descriptions-item>
                        <a-descriptions-item label="Time">
                            {{ payload.time && moment(times.find(e => e.id == payload.time).time).format('hh:mm a')}}
                        </a-descriptions-item>
                        <a-descriptions-item label="Bus No.">
                            {{bus.plate_number}}
                        </a-descriptions-item>
                        <a-descriptions-item label="Seat">
                            {{isGroup ? members.map(x => x.seat).join(', ') : payload.seat}}
                        </a-descriptions-item>
                    </a-descriptions>
                    <h2 style="margin-top:1em">Total Payable: {{totalFare}}</h2>
                    <a-button type="primary" size="large" @click="submit">
                        SUBMIT
                    </a-button>
                </div>
            </a-form-model>
            <a-skeleton v-else></a-skeleton>
        </a-drawer>
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
                'child',
                'adult',
                'pwd',
                'senior',
                'pregnant'
            ],
            step: 0,
            bus: {},
            members:[],
            isGroup: 0,
            errors: [],
            discounts: [],
            loading: true,
            loadingSubmit: false,
            bookingFormVisible: false,
            trips: [],
            times:[],
            notAvailable: [],
            payload: {},
        }
    },
    computed: {
        totalFare() {
            let members = this.isGroup ? this.members.length : 1;
            return this.formatNumber(this.getAbsoluteFare(this.payload.trip) * members);
        },
        getTripSumarry() {
            try {
               let trip =  this.trips.find( e => e.id == this.payload.trip)
               return `${trip.start} - ${trip.end}`
            } catch(error) {
                return '--'
            }
        }
    },
    methods: {
        moment,
        deepCopy,
        uploadedHandler(file) {
            this.payload.discount_image_proof = file
        },
        review() {
            this.step ++;
        },
        async fetchSlots() {
            try {
                let {date, time: time_id} = this.payload
                let { data } = await window.axios.post('/api/fetch-slot', {date: window.moment(date).format('YYYY-MM-DD'), time_id, bus_id: this.bus.id})
                console.log('fetchSlots >> ', data)
                this.notAvailable = data.map( x => x.seat);
            } catch (error) {
                console.log("fetch slot error ", error)
            }
        },
        async fetchBus() {
            try {
                this.loading =  true
                let {trip: trip_id, time: time_id} = this.payload
                let { data } = await window.axios.post('/api/fetch-bus', {trip_id, time_id});
                this.bus = data
                if (this.bus) {
                    this.fetchSlots();
                }
                this.step ++
            } catch (err) {
                console.log('Discount error >> ', err)
            } finally {
                this.loading = false
            }
        },
        addMember () {
            this.members.push({seat:null, type:null})
        },
        setGroup(index) {
            this.isGroup = index
            this.step = 1
        },
        async submit() {
            try {
                let members = this.isGroup ? this.members.length : 1;
                this.loadingSubmit = true
                this.payload.amount_payable = (this.getAbsoluteFare(this.payload.trip) * members)
                let tripId = this.payload.trip
                this.payload.trip_id = tripId
                this.payload.member = this.isGroup ? this.members.length : 1;
                this.payload.time_id = this.payload.time
                this.payload.date = window.moment(this.payload.date).format('YYYY-MM-DD')
                this.payload.bus_id = this.bus.id
                this.payload.seat = this.isGroup ? this.members.map(e => e.seat).join(',') : this.payload.seat;
                this.payload.type = this.isGroup ? this.members.map(e => e.type).join(',') : this.payload.type;
                this.payload.user_id = this.deepCopy(this.userId)
                await window.axios.post('/api/booking', { ...this.payload })
                this.$notification.success({message:'Success', description: 'Booked successfully!'})
            } catch(err) {
                this.$notification.error({message:'Error', description: err.message})
            } finally {
                this.loadingSubmit = false
                this.payload = {}
                this.errors = []
                window.location.reload()
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
