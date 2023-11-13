<template>
    <div>
        <a-drawer :visible="isFeedback" :width="500" @close="isFeedback = false; driver = {}">
            <a-form-model :model="feedbackPayload">
                <a-form-model-item label="Star">
                    <a-rate v-model="feedbackPayload.star" />
                </a-form-model-item>
                <a-form-model-item label="Message">
                    <a-textarea v-model="feedbackPayload.message"></a-textarea>
                </a-form-model-item>
                <a-button type="primary" :loading="isSaving"  @click="saveFeedback">
                    Send
                </a-button>
            </a-form-model>
        </a-drawer>
        <a-card >
            <a-row slot="title" type="flex" align="middle" :gutter="[4, 4]" >
                <a-col>
                    <h1>Bookings</h1>
                </a-col>
                <a-col>
                    <a-input-search v-model="search"></a-input-search>
                </a-col>
            </a-row>
        </a-card>
        <a-table style="background:white;" size="small"
        :columns="[
            {
                title: 'Date',
                dataIndex: 'created_at',
                key: 'date',
            },
            {
                title: 'Pick Up',
                dataIndex: 'from_address',
                key: 'pick up'
            },
            {
                title: 'Drop off',
                dataIndex: 'to_address',
                key: 'drop_off'
            },
            {
                title: 'Status',
                dataIndex: 'status',
                key: 'status',
                scopedSlots: { customRender: 'status' }
            },
            {
                title: 'Location',
                dataIndex: 'status',
                key: 'location',
                scopedSlots: { customRender: 'location' }
            },
            {
                title: 'Action',
                dataIndex: 'status',
                key: 'action',
                scopedSlots: { customRender: 'action' }
            }
        ]"
        :data-source="bookings.filter( booking => JSON.stringify(booking).toLowerCase().includes(search.toLowerCase()))">
            <div slot="action" slot-scope="status, record">
                <a-button :disabled="status == 'PENDING' || record.feedback.find( f => f.user_id == $page.props.user.id)" @click="writeFeedback(record)">
                    Send Feedback
                </a-button>
            </div>
            <div slot="location" slot-scope="location, record">
                <a :href="`/map/${record.server.id}`" target="_blank">View Location</a>
            </div>
            <div  slot="status" slot-scope="status">
                <a-tag :color="status == 'PENDING' ? 'blue': status == 'APPROVED' ? 'green': 'red'">
                    {{status}}
                </a-tag>
            </div>
        </a-table>
    </div>
</template>


<script>
import MainLayout from '../Layouts/Main.vue';
export default {
    layout: MainLayout,
    props: ['bookings'],
    methods: {
        writeFeedback(driver) {
            this.isFeedback = true;
            this.driver = driver;
        },
        async saveFeedback() {
            this.isSaving = true;
            await window.axios.post('/feedback', {
                message: this.feedbackPayload.message,
                driver_id: this.driver.server_id,
                booking_id: this.driver.id,
                star: this.feedbackPayload.star,
            })


            this.isFeedback = false;

            this.$notification.success({message:'Success', description: 'Feedback sent!'});
        }
    },
    data () {
        return {
            isFeedback: false,
            isSaving: false,
            feedbackPayload: {},
            driver: {},
            search: '',
            feedbackValue: 0,
        }
    }
}
</script>