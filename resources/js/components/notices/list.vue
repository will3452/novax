<template>
    <a-card title="Notices">
        <a-table :loading="tableLoading" :columns="noticeColumn" :data-source="noticeData">
            <template slot="date" slot-scope="date">
                {{formatDate(date)}}
            </template>
            <template slot="action" slot-scope="item, record">
                <a-button size="small" type="primary" @click="view(record)">view details</a-button>
            </template>
        </a-table>
        <a-modal title="notice" v-model="modalShow" :footer="null">
            <a-descriptions  :column="1">
                <a-descriptions-item label="Subject">
                    {{notice.subject}}
                </a-descriptions-item>
                <a-descriptions-item label="Message">
                    {{notice.message}}
                </a-descriptions-item>
                <a-descriptions-item label="Date">
                    {{formatDate(notice.created_at)}}
                </a-descriptions-item>
            </a-descriptions>
        </a-modal>
    </a-card>
</template>

<script>
import { formatDate } from '../../global.js'
export default {
    data () {
        return {
            modalShow: false,
            notice: {},
            tableLoading: true,
            noticeData: null,
            noticeColumn: [
                {
                    dataIndex: 'created_at',
                    title: 'Date',
                    key: 'date',
                    scopedSlots: {customRender: 'date'}
                },
                {
                    dataIndex: 'subject',
                    title: 'Subject',
                    key: 'subject'
                },
                {
                    dataIndex: 'message',
                    title: 'Action',
                    key: 'action',
                    scopedSlots: {customRender: 'action'}
                }
            ],
        }
    },
    async mounted () {
        await this.loadNotices()
    },
    methods: {
        formatDate,
        view(record) {
            this.notice = { ... record}
            this.modalShow = true
        },
        async loadNotices () {
            try {
                    let { data } = await window.axios.get('/api/latest-notices')
                    this.noticeData = await JSON.parse(JSON.stringify(data))
                    console.log(typeof this.noticeData)
            } catch (err) {
                console.log("Error >> ", err)
            } finally {
                this.tableLoading = false
            }
        }
    }
}
</script>
