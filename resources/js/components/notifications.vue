<template>
    <a-card title="Notifications">
        <a-list item-layout="horizontal" :data-source="notifications">
        <a-list-item slot="renderItem" slot-scope="item, index">
        <a-list-item-meta
            :description="item.data.message || 'No details.'"
        >
        <a-icon type="bell" slot="avatar"/>
            <a slot="title" href="#">{{ formatDate(item.created_at) }}</a>

        </a-list-item-meta>
        </a-list-item>
    </a-list>
    </a-card>
</template>

<script>
import { formatDate } from '../global.js'
    export default {
        props: ['userId'],
        async mounted () {
            let {data} = await window.axios.get('/api/notifications?user=' + this.userId)
            this.notifications = data
        },
        methods: {
            formatDate,
        },
        data () {
            return {
                notifications: [],
            }
        }
    }
</script>
