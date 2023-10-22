<template>
    <a-card title="Notifications">
        <a-table :columns="[
            {
                title: 'Messages',
                dataIndex: 'data.message',
                key: 'message',
            },
            {
                title: 'Date',
                dataIndex: 'created_at',
                key: 'date',
            }
        ]" :data-source="notifications"></a-table>
    </a-card>
</template>

<script>
import Main from '../Layouts/Main.vue';

export default {
    layout: Main,
    props: ['notifications'],
}
</script>
