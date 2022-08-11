<template>
    <div>
        <a-card title="Notices" :loading="loading">
            <a href="" slot="extra" href="/notices">View All</a>
            <a-table
            size="small"
            :data-source="notices"
            :columns="columns">
            <span slot="date" slot-scope="item, record">
                {{getDate(item)}}
            </span>
            <span slot="actions" slot-scope="item, record">
                <a-button type="primary" size="small" @click="showRecord(record)">show</a-button>
            </span>
            </a-table>
        </a-card>
        <a-modal title="notice" v-model="modalShow" :footer="null">
            <a-descriptions  :column="1">
                <a-descriptions-item label="Subject">
                    {{notice.subject}}
                </a-descriptions-item>
                <a-descriptions-item label="Message">
                    {{notice.message}}
                </a-descriptions-item>
                <a-descriptions-item label="Date">
                    {{getDate(notice.created_at)}}
                </a-descriptions-item>
            </a-descriptions>
        </a-modal>
    </div>
</template>

<script>
export default {
    mounted() {
        this.loadNotices()
    },
    methods: {
        showRecord(record) {
            this.modalShow = true
            this.notice = record
        },
        getDate(item) {
            return window.moment(item).format('MMM Do YY')
        },
        async loadNotices() {
            try {
                let { data } = await window.axios.get('/api/latest-notices?limit=5')
                this.notices = JSON.parse(JSON.stringify(data))
            } catch (err) {
                this.$notification.error({message:'Error', description: error.message})
            } finally {
                this.loading = false
            }
        }
    },
    data() {
        return {
            loading: true,
            notice: {},
            modalShow:false,
            notices: [],
            columns: [
                {dataIndex: 'created_at', key: 'created_at', title: 'Date', scopedSlots: {customRender: 'date'}},
                {dataIndex: 'subject', key: 'subject', title: 'Subject'},
                {dataIndex: 'created_at', key: 'action', title: 'Action', scopedSlots: {customRender: 'actions'}},
            ]
        }
    }
}
</script>
