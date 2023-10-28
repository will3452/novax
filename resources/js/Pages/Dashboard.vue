<template>
    <div>
        <div v-if="$page.props.user.code_verified == '0'">
            <p>Your account is not yet verified, Please enter the SMS verification sent to your Mobile No.</p>
            <a-popover content="Resend OTP">
                <a-button icon="redo" @click="sendOtp"></a-button>
            </a-popover>
            <a-input placeholder="Please enter Verification code."  v-model="code" style="max-width: 300px;"></a-input> <a-button icon="check" type="primary" @click="verified">SUBMIT</a-button>
        </div>
        <div v-else>
            <a-drawer :visible="viewDetail" @close="viewDetail = false" :width="700" title="Booking details">
            <l-map ref="map" style="height:150px; " zoom="15" :center="[details.from_lat, details.from_lng]">
                <l-tile-layer url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png" />
                <l-marker draggable :lat-lng="[details.from_lat, details.from_lng]" >
                    <l-icon>
                        <img src="../pin.png" style="width:25px;" class="blink">
                    </l-icon>
                </l-marker>
                <l-marker draggable :lat-lng="[details.to_lat, details.to_lng]" >
                    <l-icon>
                        <img src="../flag.png" style="width:25px;" class="blink">
                    </l-icon>
                </l-marker>
            </l-map>
            <a-descriptions :column="1" bordered>
                <a-descriptions-item label="Client" >
                    {{ details && details.client && details.client.name }}
                </a-descriptions-item>
                <a-descriptions-item label="Status" >
                    {{ details && details.status }}
                </a-descriptions-item>
                <a-descriptions-item label="Origin" >
                    {{ details && details.from_address }}
                </a-descriptions-item>
                <a-descriptions-item label="Destination" >
                    {{ details && details.to_address }}
                </a-descriptions-item>
                <a-descriptions-item label="Total Amount" >
                   PHP {{ parseFloat(details && details.amount).toFixed(2) }}
                </a-descriptions-item>
            </a-descriptions>
            <div style="margin-top: 1em; " v-if="details.status == 'PENDING'">
                <a-button type="primary" @click="$inertia.post('/approve/' + details.id, {}, {onSuccess: () => viewDetail = false})">APPROVE</a-button>
                <a-button type="danger" @click="$inertia.post('/reject/' + details.id, {}, {onSuccess: () => viewDetail = false})">REJECT</a-button>
            </div>
        </a-drawer>
        <br>
       <a-row :gutter="[12, 12]" type="flex" justify="center">
        <a-col :md="24" :xs="24">
            <!-- <a-row type="flex">
                <a-col :span="8">
                    <apexchart type="bar" :options="options" :series="series"></apexchart>
                </a-col>
                <a-col :span="8">
                    <apexchart  type="line" :options="options" :series="series"></apexchart>
                </a-col>

                <a-col :span="8">
                    <apexchart type="area" :options="options" :series="series"></apexchart>
                </a-col>
            </a-row> -->
            <a-card title="BOOKINGS" v-if="$page.props.user.type == 'Client'">
                <div class="ct-chart"></div>
                <a-row type="flex" :gutter="[12, 12]">
                    <a-col :span="12">
                        <a-button size="large" block type="primary" icon="select" @click="$inertia.visit('/booking')">BOOK NOW</a-button>
                    </a-col>
                    <a-col :span="12">
                        <a-button size="large" block type="secondary" icon="ordered-list" @click="$inertia.visit('/bookings')">VIEW LIST</a-button>
                    </a-col>
                </a-row>
            </a-card>
            <a-card title="BOOKING REQUESTS" v-if="$page.props.user.type == 'Driver'">
                <a-button slot="extra">VIEW ALL</a-button>
                <div class="ct-chart"></div>
                <a-table bordered :data-source="$page.props.requests" :pagination="false" :columns="requestColumns">
                    <template slot="date" slot-scope="text">
                        <span>
                            {{ moment(text).fromNow() }}
                        </span>
                    </template>
                    <template slot="action" slot-scope="text, record">
                        <a-button icon="eye" @click="showDetails(record)">view</a-button>
                    </template>
                    <template slot="amount" slot-scope="text, record">
                        <div>
                            {{parseInt(record.qty) * text}}
                        </div>
                    </template>
                </a-table>

            </a-card>
            <br>
        </a-col>
        <!-- <a-col :md="8" :xs="24">
            <a-card title="ACTIVITY LOGS">
                <a-button size="large" block type="primary" icon="align-left">VIEW ALL</a-button>
            </a-card>
        </a-col> -->
       </a-row>
        </div>
    </div>
</template>


<script>
import MainVue from '../Layouts/Main.vue'
var moment = window.moment;
export default {
    layout: MainVue,
    mounted() {
        navigator.geolocation.getCurrentPosition((position) => {
            let {coords} = position;
            this.lat = coords.latitude;
            this.lng = coords.longitude;
        })

        // chart
        var chart = new Chartist.Line('.ct-chart', {
        series: [
            {
            name: 'Bookings',
            // data: [
            //     {x: new Date(143134652600), y: 53},
            //     {x: new Date(143234652600), y: 40},
            //     {x: new Date(143340052600), y: 45},
            //     {x: new Date(143366652600), y: 40},
            //     {x: new Date(143410652600), y: 20},
            //     {x: new Date(143508652600), y: 32},
            //     {x: new Date(143569652600), y: 18},
            //     {x: new Date(143579652600), y: 11}
            // ]
            data: (this.$page.props.user.type == 'Client' ? this.$page.props.bookings: this.$page.props.requests).map(item => ({x: window.moment(item.created_at), y: item.amount}))
            },
  ]
}, {
  axisX: {
    type: Chartist.FixedScaleAxis,
    divisor: 5,
    labelInterpolationFnc: function(value) {
      return moment(value).format('MMM D');
    }
  }
});
    },
    methods: {
        async verified () {
            try {
                this.isLoading = true;
                await window.axios.post('/verified', {code: this.code});
                this.$notification.success({message:'success', description: 'Verified successfully!'})
                window.location.reload();
            } catch (error) {
                this.$notification.error({message:'error', description: 'Incorrect code!'});
            }
        },
        async sendOtp() {
            this.isLoading = true;
            await window.axios.post('/send-otp', {mobile: this.$page.props.user.mobile});
            this.isLoading = false;
            this.$notification.success({message:'Success', description: 'OTP sent to your register no.'})
        },
        clickHandler(event) {
            console.log(event)
        },
        async showDetails(record) {
            this.viewDetail = true;
            this.details = record;
            // get the routes
            let result = await window.axios.get(`https://router.project-osrm.org/route/v1/driving/${this.details.from_lng},${this.details.from_lat};${this.details.to_lng},${this.details.to_lat}?overview=false`)
            console.log(result)
        },
        markerChange(event) {
            console.log(event);
        }
    },
    data() {
        return {
            code: '',
            options: {
                chart: {
                id: 'vuechart-example'
                },
                xaxis: {
                categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998]
                }
            },
            series: [{
                name: 'series-1',
                data: [30, 40, 45, 50, 49, 60, 70, 91]
            }],
            details:{},
            viewDetail: false,
            moment,
            requestColumns: [
                    {
                        title: 'Date',
                        key: 'date',
                        dataIndex: 'created_at',
                        scopedSlots: { customRender: 'date' },
                    },
                    {
                        title: 'Status',
                        key: 'status',
                        dataIndex: 'status',
                    },
                    {
                        title: 'Origin',
                        key: 'orgin',
                        dataIndex: 'from_address',
                    },
                    {
                        title: 'Destination',
                        key: 'destination',
                        dataIndex: 'to_address',
                    },
                    {
                        title: 'Fee',
                        key: 'fee',
                        dataIndex: 'amount',
                    },
                    {
                        title: 'Total Fee',
                        key: 'fee',
                        dataIndex: 'amount',
                        scopedSlots: { customRender: 'amount' },
                    },
                    {
                        title: 'Qty',
                        key: 'qty',
                        dataIndex: 'qty',
                    },
                    {
                        title: 'Action',
                        key: 'Action',
                        dataIndex: 'id',
                        scopedSlots: { customRender: 'action' },
                    },
                ],
            lat:0,
            lng: 0,
            loading: true,
        }
    }
}
</script>

<style>
.ct-series-a .ct-line {
  /* Set the colour of this series line */
  stroke: #1890ff;
}

.ct-series-a .ct-point {
  /* Colour of your points */
  stroke: #1890ff;
}
</style>
