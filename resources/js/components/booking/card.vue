<template>
    <div>
        <dashboard-card
        style="margin-right:1em; width: 300px;background-image: linear-gradient(to bottom, #3BC062 , #2DB15A);color:white; border: none;border-radius: 1em;"
        icon="pushpin"
        label="Booking"
        >
            <a-button type="ghost" block @click="viewForm" >
                Book Now
            </a-button>
        </dashboard-card>
        <a-drawer title="Booking Form" :width="400" :visible="bookingFormVisible" @close="closeHandler">
            <a-form-model v-if="!loading">
                <a-form-model-item label="Select Trip">
                    <a-select v-model="payload.trip" allow-clear>
                        <a-select-option :key="trip" :value="trip.id" v-for="trip in trips">
                            <div>
                                {{trip.start}} - {{trip.end}}
                            </div>
                        </a-select-option>
                    </a-select>
                </a-form-model-item>
                <a-form-model-item label="Date">
                    <a-date-picker :disabled-date="disabledDate" style="width:100%"></a-date-picker>
                </a-form-model-item>
                <a-alert v-if="getRemarks(payload.trip)" type="info" message="Other Info." :description="getRemarks(payload.trip)"></a-alert>
                <a-descriptions>
                    <a-descriptions-item label="Fare">
                        <span style="font-size:32px">{{getFare(payload.trip) || '0.00'}}</span>
                    </a-descriptions-item>
                </a-descriptions>
                <a-button type="primary" size="large" :loading="loadingSubmit" @click="submit" block>Book now</a-button>
                <a-alert style="margin-top: 1em;" type="warning" show-icon description="Your booking request is still required to be reviewed for admin approval."></a-alert>
            </a-form-model>
            <a-skeleton v-else></a-skeleton>
        </a-drawer>
    </div>
</template>

<script>
import moment from 'moment'
export default {
    data () {
        return {
            loading: true,
            loadingSubmit: false,
            bookingFormVisible: false,
            trips: [],
            payload: {},
        }
    },
    methods: {
        moment,
        submit() {
            this.loadingSubmit = true
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
        getFare(tripId) {
            let trip = this.getTripDetails(tripId)
            let fare = 0
            if (trip) {
                fare = trip.fare
            }
            let formatter = new Intl.NumberFormat('en-Us', {style: 'currency', currency: 'PHP' })
            return formatter.format(fare)
        },
        async viewForm() {
            this.bookingFormVisible = true
            await this.loadTrips()
        },
        closeHandler () {
            this.payload = {}
            this.bookingFormVisible = false
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
