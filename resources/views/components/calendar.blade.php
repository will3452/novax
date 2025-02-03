<div id="calendar"></div>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar/index.global.min.js'></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            slotMinTime: '8:00:00',
            slotMaxTime: '19:00:00',
            events: @json(\App\Models\Event::get()),
        });
        calendar.render();

        calendar.on('dateClick', function (info) {
            console.log(info)
        })
    });
</script>
