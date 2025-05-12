import './bootstrap';
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';

// Initialize the calendar when the DOM is fully loaded
document.addEventListener('DOMContentLoaded', () => {
    const calendarEl = document.getElementById('calendar');
    const calendarDataEl = document.getElementById('calendar-data');

    if (calendarEl && calendarDataEl) {
        const appointments = JSON.parse(calendarDataEl.dataset.appointments);
        
        // Initialize the calendar
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
            },
            dateClick: function(info) {
                // Set the date in the form
                window.Livewire.emit('openAppointmentForm', info.dateStr);
            }
        });

        // Render the calendar
        calendar.render();

        // Listen for Livewire events to add new appointments
        window.Livewire.on('appointmentAdded', (newAppointment) => {
            calendar.addEvent(newAppointment);
        });
    }
});
