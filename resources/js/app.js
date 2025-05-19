import "./bootstrap";
import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import interactionPlugin from "@fullcalendar/interaction";
import listPlugin from "@fullcalendar/list";
import momentPlugin from "@fullcalendar/moment";
import momentTimezonePlugin from "@fullcalendar/moment-timezone";

// // Initialize the calendar when both DOM and Livewire are fully loaded
// const initCalendar = () => {
//     const calendarEl = document.getElementById('calendar');
//     const calendarDataEl = document.getElementById('calendar-data');

//     if (calendarEl && calendarDataEl) {
//         const appointments = JSON.parse(calendarDataEl.dataset.appointments);
//         const vetId = calendarDataEl.dataset.vetId;



//         // Initialize the calendar
//         const calendar = new Calendar(calendarEl, {
//             plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],
//             initialView: 'dayGridMonth',
//             height: 'auto',
//             headerToolbar: {
//                 left: 'prev,next today',
//                 center: 'title',
//                 right: 'dayGridMonth,timeGridWeek,timeGridDay'
//             },
//             events: appointments,
//             nowIndicator: true,
//             timeZone: 'local',
//             firstDay: 1, // Start week on Monday
//             dayMaxEvents: 3, // Show "+X more" when too many events
//             eventDisplay: 'block',
//             eventTimeFormat: { // Custom time format
//                 hour: '2-digit',
//                 minute: '2-digit',
//                 meridiem: false,
//                 hour12: false
//             },
//             eventDidMount: function(info) {
//                 // Add tooltip with more details
//                 if (info.event.extendedProps.notes) {
//                     info.el.setAttribute('title', info.event.extendedProps.notes);
//                 }
//             },
//             eventClick: function(info) {
//                 const event = info.event;
//                 const props = event.extendedProps;
//                 const eventDetails = `
//                     <div class="p-4">
//                         <h3 class="text-lg font-semibold mb-2">${event.title}</h3>
//                         <p><strong>Status:</strong> <span class="capitalize">${event.extendedProps.status || 'scheduled'}</span></p>
//                         <p><strong>Date:</strong> ${event.start?.toLocaleString()}</p>
//                         ${props.pet_name ? `<p><strong>Pet:</strong> ${props.pet_name}</p>` : ''}
//                         ${props.owner_name ? `<p><strong>Owner:</strong> ${props.owner_name}</p>` : ''}
//                         ${props.notes ? `<p class="mt-2"><strong>Notes:</strong> ${props.notes}</p>` : ''}
//                     </div>
//                 `;

//                 // You can replace this with a modal or custom UI component
//                 Swal.fire({
//                     html: eventDetails,
//                     showCancelButton: true,
//                     confirmButtonText: 'Edit',
//                     cancelButtonText: 'Close',
//                     showDenyButton: true,
//                     denyButtonText: 'Cancel Appointment',
//                     confirmButtonColor: '#3b82f6',
//                     cancelButtonColor: '#6b7280',
//                     denyButtonColor: '#ef4444',
//                 }).then((result) => {
//                     if (result.isConfirmed) {
//                         // Handle edit
//                         window.Livewire.emit('editAppointment', event.id);
//                     } else if (result.isDenied) {
//                         // Handle cancel
//                         window.Livewire.emit('cancelAppointment', event.id);
//                     }
//                 });
//             },
//             dateClick: function(info) {
//                 // Only allow future dates
//                 const clickedDate = new Date(info.date);
//                 const today = new Date();
//                 today.setHours(0, 0, 0, 0);

//                 if (clickedDate >= today) {
//                     window.location.href = `{{ route('appointments.create', ['veterinarianProfile' => $veterinarianProfile->id]) }}?date=${info.dateStr}`;
//                 } else {
//                     Swal.fire({
//                         icon: 'warning',
//                         title: 'Invalid Date',
//                         text: 'Please select a current or future date.',
//                         confirmButtonColor: '#3b82f6',
//                     });
//                 }
//             },
//             loading: function(isLoading) {
//                 // Show/hide loading indicator
//                 document.getElementById('calendar-loading').style.display =
//                     isLoading ? 'block' : 'none';
//             }
//         });

//         // Render the calendar
//         calendar.render();

//         // Listen for Livewire events
//         window.Livewire.on('appointmentAdded', (newAppointment) => {
//             calendar.addEvent({
//                 ...newAppointment,
//                 className: `event-${newAppointment.status?.toLowerCase() || 'scheduled'}`,
//                 borderColor: 'transparent',
//                 textColor: 'white'
//             });
//         });

//         window.Livewire.on('appointmentUpdated', (updatedAppointment) => {
//             const event = calendar.getEventById(updatedAppointment.id);
//             if (event) {
//                 event.setProp('title', updatedAppointment.title);
//                 event.setStart(updatedAppointment.start);
//                 event.setEnd(updatedAppointment.end || updatedAppointment.start);
//                 event.setExtendedProp('status', updatedAppointment.extendedProps.status);
//                 event.setProp('className', `event-${updatedAppointment.status?.toLowerCase() || 'scheduled'}`);
//             }
//         });

//         window.Livewire.on('appointmentDeleted', (appointmentId) => {
//             const event = calendar.getEventById(appointmentId);
//             if (event) {
//                 event.remove();
//             }
//         });

//         // Handle window resize for better mobile experience
//         let resizeTimer;
//         window.addEventListener('resize', () => {
//             clearTimeout(resizeTimer);
//             resizeTimer = setTimeout(() => {
//                 calendar.updateSize();
//             }, 250);
//         });
//     }
// };

// // Initialize the calendar when Livewire is ready
// const initLivewireCalendar = () => {
//     if (window.Livewire && !window.calendarInitialized) {
//         initCalendar();
//         window.calendarInitialized = true;
//     }
// };

// // Try to initialize immediately if Livewire is already loaded
// if (window.Livewire) {
//     initLivewireCalendar();
// }

// // Also listen for Livewire's load event
// window.addEventListener('livewire:load', () => {
//     initLivewireCalendar();
// });

// // Fallback to DOMContentLoaded as a last resort
// document.addEventListener('DOMContentLoaded', () => {
//     if (window.Livewire && !window.calendarInitialized) {
//         initLivewireCalendar();
//     }
// });
