<template>
    <a-card title="Notices">
        <a-table :loading="tableLoading" :columns="noticeColumn" :data-source="noticeColumn">

        </a-table>
    </a-card>
</template>

<script>
import { deepCopy } from '../../global.js'
export default {
    data () {
        return {
            tableLoading: true,
            noticeData: null,
            noticeColumn: [
                {
                    dataIndex: 'created_at',
                    title: 'Date',
                    key: 'date'
                },
                {
                    dataIndex: 'subject',
                    title: 'Subject',
                    key: 'subject'
                },
                {
                    dataIndex: 'message',
                    title: 'Message',
                    key: 'message'
                }
            ],
        }
    },
    async mounted () {
        try {
                 let { data } = await window.axios.get('/api/latest-notices?limit=5')
                this.noticeData = await JSON.parse(JSON.stringify(data))
                console.log(typeof this.noticeData)
        } catch (err) {
            console.log("Error >> ", err)
        } finally {
            this.tableLoading = false
        }
    }
}
</script>
