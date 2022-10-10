<template>
    <div>
        <vc-calendar is-expanded :attributes="attrs"></vc-calendar>
    </div>
</template>

<script>
export default {
    props: [
        'card',

        // The following props are only available on resource detail cards...
        // 'resource',
        // 'resourceId',
        // 'resourceName',
    ],

    mounted() {
        this.attrs = this.card.appointments.map( e => ({
            key: 'appointment '+ e.id,
            dot: 'green',
            dates: new Date(e.date),
            popover: {
                label: `[${e.time}] - ${e.user.name}`,
            }
        }));
    },
    data() {
        return {
            attrs: [],
        }
    }
}
</script>
