<template>
    <div>
        <br>
       <a-row :gutter="[12, 12]" type="flex" justify="center">
        <a-col :md="8">
            <a-card title="BOOKINGS">
                <div class="ct-chart"></div>
                <a-row type="flex" :gutter="[12, 12]">
                    <a-col :span="12">
                        <a-button size="large" block type="primary" icon="select" @click="$inertia.visit('/booking')">BOOK NOW</a-button>
                    </a-col>
                    <a-col :span="12">
                        <a-button size="large" block type="secondary" icon="ordered-list">VIEW LIST</a-button>
                    </a-col>
                </a-row>
            </a-card>
        </a-col>
        <a-col :md="8">
            <a-card>
                <a-row type="flex" justify="space-between">
                    <a-col>
                        FEEDBACK
                    </a-col>
                    <a-col>

                    </a-col>
                </a-row>
                <a-button size="large" block type="primary" icon="message">VIEW FEEDBACK</a-button>
            </a-card>
        </a-col>
       </a-row>

    </div>
</template>


<script>


import MainVue from '../Layouts/Main.vue'
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
            data: this.$page.props.bookings.map(item => ({x: window.moment(item.created_at), y: item.amount}))
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
        clickHandler(event) {
            console.log(event)
        },
        markerChange(event) {
            console.log(event);
        }
    },
    data() {
        return {
            lat:0,
            lng: 0,
            loading: true,
        }
    }
}
</script>
