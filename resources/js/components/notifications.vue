<template>
    <a-card title="Notifications">
        <a-list item-layout="horizontal" :data-source="notifications">
        <a-list-item slot="renderItem" slot-scope="item, index">
        <a-list-item-meta
            :description="item.message"
        >
            <a slot="title" href="https://www.antdv.com/">{{ formatDate(item.created_at) }}</a>
            <div slot="avatar">
                <a-icon type="bell"></a-icon>
            </div>
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
