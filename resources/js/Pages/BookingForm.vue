<template>
    <a-spin :spinning="payload.processing || loading">
        <a-drawer title="feedback" :visible="viewFeedback" :width="450" @close="viewFeedback = false">
            <a-empty></a-empty>
        </a-drawer>
        <a-row>
            <a-col :md="24">
                <a-steps :current="currentStep"  type="navigation">
                    <a-step title="Pick-up">
                    </a-step>
                    <a-step title="Drop" />
                    <a-step title="Driver" />
                    <a-step title="Summary" />
                </a-steps>
            </a-col>
            <a-col :md="24"  style="height:80vh;">

                <!-- SELECT DRIVER HERE -->

                <div v-show="currentStep == 3" style="padding: 1em; ">
                    <a-descriptions :column="1" bordered title="Booking information">
                        <a-descriptions-item label="Pick-Up">
                            {{ payload.steps[0] && payload.steps[0].address }}
                        </a-descriptions-item>
                        <a-descriptions-item label="Drop">
                            {{ payload.steps[1] && payload.steps[1].address }}
                        </a-descriptions-item>
                        <a-descriptions-item label="Driver">
                            {{ payload.driver ? payload.driver.name: '---' }}
                        </a-descriptions-item>
                        <a-descriptions-item label="Distance">
                            {{ _distance && _distance.text}}
                        </a-descriptions-item>
                        <a-descriptions-item label="Total">
                            PHP {{fee}}
                        </a-descriptions-item>
                    </a-descriptions>
                </div>

                <div v-show="currentStep == 2" >
                    <div  style="padding: 2em;padding-bottom: 0; ">
                        <a-input-search placeholder="Search Driver" size="large"/>
                    </div>

                    <a-list item-layout="horizontal" :data-source="$page.props.drivers"  style="padding: 2em; ">
                        <a-list-item slot="renderItem" slot-scope="item, index" style="background: #fff; padding: 1em; ">
                        <a-list-item-meta
                        >
                        <a-rate size="small" value="3" slot="description"></a-rate>
                            <a slot="title" href="https://www.antdv.com/">{{ item.name }}</a>
                            <a-avatar
                                slot="avatar"
                                src="https://zos.alipayobjects.com/rmsportal/ODTLcjxAfvqbxHnVXCYX.png">
                                </a-avatar>
                        </a-list-item-meta>
                            <a-button icon="star" style="margin-right: .5em;" @click="selectFeedback(item)">
                                View feedback
                            </a-button>
                            <a-button @click="selectDriver(item)" icon="select" :type="item.id == payload.driverId ? 'primary': 'secondary'">
                                Select
                            </a-button>
                        </a-list-item>
                    </a-list>
                </div>
            <!-- END SELECT DRIVER HERE -->

                <div v-show="currentStep == 0 || currentStep == 1">
                    <a-card :title="`ADDRESS : ${address.display_name}`">

                    </a-card>
                    <l-map :center="[lat, lng]" style="height:60vh;" @click="clickHandler" :zoom="18">
                        <l-tile-layer url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png" />
                        <l-marker draggable :lat-lng="[lat, lng]" @update:lat-lng="markerChange">
                            <l-icon>
                                <img src="../pin.png" style="width:25px;" class="blink">
                            </l-icon>
                        </l-marker>
                    </l-map>
                </div>
                <a-row>
                    <a-col :span="12" class="_button prev" @click="currentStep ? currentStep-- : null" :class="{'disabled' : currentStep == 0}">
                        <a-icon type="left"></a-icon>
                        BACK
                    </a-col>
                    <a-col :span="12" class="_button next" @click="next">
                        {{ currentStep == 3 ? "PROCEED": "NEXT" }}
                        <a-icon type="right"></a-icon>
                    </a-col>
                </a-row>
            </a-col>
        </a-row>
    </a-spin>
</template>

<script>
import MainVue from '../Layouts/Main.vue'
export default {
    layout: MainVue,
    computed: {
        _distance() {
            try {
                return this.distance && this.distance.rows && this.distance.rows[0] && this.distance.rows[0].elements &&  this.distance.rows[0].elements[0] && this.distance.rows[0].elements[0].distance;
            } catch(error) {
                return {}
            }
        },
        fee() {
            try {
                let distanceInKm = parseInt(this._distance.value / 1000) - 4;
                if (distanceInKm < 0) {
                    distanceInKm = 0;
                }
                return (parseFloat(this.$page.props.fd) + (distanceInKm * parseFloat(this.$page.props.af))).toFixed(2);
            } catch (error) {
                return parseFloat(this.$page.props.fd).toFixed(2)
            }
        }
    },
    methods: {
        async getDistance() {
            try {
                let result = await window.axios.get(`https://api.distancematrix.ai/maps/api/distancematrix/json?origins=${this.payload.steps[0].lat},${this.payload.steps[0].lng}&destinations=${this.payload.steps[1].lat},${this.payload.steps[1].lng}&key=BPMWph1aG0FWmmQkMuefmSYO4n5W6`)
                console.log(result);
                return result.data;
            } catch (error) {
                return {}
            }
        },
        async getAddress(lat, lng) {
            try {
                let result = await window.axios.get(`https://geocode.maps.co/reverse?lat=${lat}&lon=${lng}`);
                console.log(result);

                return result.data;
            } catch (error) {
                return {};
            }
        },
        async next(e) {
            if (this.currentStep == 0 || this.currentStep == 1) {
                this.payload.steps[this.currentStep] = { lat: this.lat, lng: this.lng, address: this.address.display_name };
            }

            if (this.currentStep == 2) {
               this.distance =  await this.getDistance();
            }

            if (this.currentStep == 3) {
                this.payload.distance = this.distance;
                this.payload.fee = this.fee;
                this.payload.post('/booking');
            } else {
                this.currentStep++;
            }

        },

        async markerChange(event) {
            this.lat = event.lat;
            this.lng = event.lng;
            this.address = await this.getAddress(this.lat, this.lng);
            console.log(event);
        },

        async clickHandler(event) {
            this.lat = event.latlng.lat;
            this.lng = event.latlng.lng;
            this.address = await this.getAddress(this.lat, this.lng);
        },
        selectDriver(driver) {
            this.payload.driverId = driver.id;
            this.payload.driver = driver;
        },
        selectFeedback(driver) {
            this.driver = driver;
            this.viewFeedback = true;
        }

    },
    mounted() {
        navigator.geolocation.getCurrentPosition((position) => {
            let { coords } = position;
            this.lat = coords.latitude;
            this.lng = coords.longitude;
            this.loading = false;
        })
    },
    data() {
        return {
            loading: true,
            distance: {},
            address: '',
            viewFeedback: false,
            driver: {},
            currentStep: 0,
            lat: 0,
            lng: 0,
            payload: this.$inertia.form({
                from_coords: '',
                to_coords: '',
                steps: [],
                driver: {},
                distance: {},
                fee: 0,
                driverId: null,
            }),
        }
    }
}
</script>

<style scoped>
    .disabled {
        background: #efefef !important;
        color: #aaa !important;
        cursor:not-allowed;
    }
    .prev {
        background: #222;
        color: white;
    }

    .next {
        background: green;
        color: white;
    }
    ._button {
        text-align: center;
        font-size: 120%;
        font-weight: 900;
        letter-spacing: 0.5em;
        padding: 1em;
        cursor:pointer;
    }
</style>
