// import './bootstrap';
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid'; // for week/day views
import interactionPlugin from '@fullcalendar/interaction'; // optional: drag/drop/click support

document.addEventListener('DOMContentLoaded', () => {
    const calendarEl = document.getElementById('calendar');
    const calendarDataEl = document.getElementById('calendar-data');

    if (calendarEl && calendarDataEl) {
        const appointments = JSON.parse(calendarDataEl.dataset.appointments);
        console.log(appointments);

        const calendar = new Calendar(calendarEl, {
            plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
            initialView: 'dayGridMonth',
            height: 650,
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: appointments,
            eventClick: function(info) {
                const props = info.event.extendedProps;
                alert(`Pet: ${info.event.title}\nStatus: ${props.status}\nNotes: ${props.notes}`);
            }
        });

        calendar.render();
    }

});



