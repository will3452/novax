<template>
    <div>
        <heading class="mb-6">Calendar</heading>
        <card class="p-4">
        <full-calendar v-if="!isLoading" :options="calendarOptions"></full-calendar>
        </card>
    </div>
</template>

<script>
import '@fullcalendar/core/vdom' // solves problem with Vite
import FullCalendar from '@fullcalendar/vue'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import timeGridPlugin from '@fullcalendar/timegrid'

export default {
    metaInfo() {
        return {
          title: 'BookingCalendar',
        }
    },
    components: {
        FullCalendar,
    },
    data() {
        return {
            isLoading:true,
            calendarOptions: {
                plugins: [ dayGridPlugin, interactionPlugin, timeGridPlugin ],
                initialView: 'dayGridMonth',
                height:500,
                headerToolbar: {
                    left:'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay',
                },
                eventClick: this.clickHandler,
            },
        }
    },
    methods: {
        clickHandler(info){
            window.location.href = '/admin/resources/bookings/' + info.event.extendedProps.id;
        }
    },
    mounted() {
        Nova.request().get('/nova-vendor/booking-calendar/get-approved-bookings')
            .then(res=>{
                this.isLoading = false;
                this.calendarOptions.events = res.data;
                console.log(this.calendarOptions.events);
            })
    },
}
</script>

<style>
/* Scoped Styles */
</style>
