import "./bootstrap";
import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import interactionPlugin from "@fullcalendar/interaction";
import listPlugin from "@fullcalendar/list";
import momentPlugin from "@fullcalendar/moment";
import momentTimezonePlugin from "@fullcalendar/moment-timezone";

// Initialize the calendar when both DOM and Livewire are fully loaded
const initCalendar = () => {
    const calendarEl = document.getElementById("calendar");
    if (!calendarEl) return;

    // Show loading state
    const loadingEl = document.getElementById("calendar-loading");
    if (loadingEl) {
        loadingEl.classList.remove("opacity-0", "pointer-events-none");
        loadingEl.classList.add("opacity-100");
    }

    // Add custom styles
    const style = document.createElement("style");
    style.textContent = `
        .fc {
            --fc-border-color: #e5e7eb;
            --fc-page-bg-color: #ffffff;
            --fc-today-bg-color: rgba(59, 130, 246, 0.05);
            --fc-now-indicator-color: #ef4444;
            --fc-button-bg-color: #3b82f6;
            --fc-button-border-color: #3b82f6;
            --fc-button-hover-bg-color: #2563eb;
            --fc-button-hover-border-color: #2563eb;
            --fc-button-active-bg-color: #1d4ed8;
            --fc-button-active-border-color: #1d4ed8;
        }
        .fc .fc-toolbar {
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }
        .fc .fc-button {
            padding: 0.4rem 0.8rem;
            font-size: 0.875rem;
            line-height: 1.25rem;
            font-weight: 500;
            border-radius: 0.375rem;
            transition: all 0.15s ease-in-out;
        }
        .fc .fc-button-primary:not(:disabled).fc-button-active,
        .fc .fc-button-primary:not(:disabled):active {
            background-color: var(--fc-button-active-bg-color);
            border-color: var(--fc-button-active-border-color);
        }
        .fc-event {
            border: none;
            border-radius: 0.25rem;
            font-size: 0.8125rem;
            font-weight: 500;
            padding: 0.25rem 0.5rem;
            margin: 0.125rem 0.25rem;
        }
        .fc-event .fc-event-time {
            font-weight: 600;
            margin-bottom: 0.125rem;
        }
        .fc-event .fc-event-title {
            white-space: normal;
            line-height: 1.25;
        }
        .fc-daygrid-event-dot {
            display: none;
        }
        .fc-day-today {
            background-color: var(--fc-today-bg-color) !important;
        }
        .fc-timegrid-now-indicator-line {
            border-color: var(--fc-now-indicator-color);
        }
    `;
    document.head.appendChild(style);

    // Initialize the calendar
    const calendar = new Calendar(calendarEl, {
        plugins: [
            dayGridPlugin,
            timeGridPlugin,
            interactionPlugin,
            listPlugin,
            momentPlugin,
            momentTimezonePlugin,
        ],
        initialView: "dayGridMonth",
        headerToolbar: {
            left: "prev,next today",
            center: "title",
            right: "dayGridMonth,timeGridWeek,timeGridDay,listWeek",
        },
        height: "auto",
        nowIndicator: true,
        editable: true,
        selectable: true,
        selectMirror: true,
        dayMaxEvents: 3,
        navLinks: true,
        timeZone: "local",
        firstDay: 1, // Monday
        dayHeaderFormat: { weekday: "short", day: "numeric" },
        dayMaxEventRows: 4,
        eventDisplay: "block",
        eventTimeFormat: {
            hour: "2-digit",
            minute: "2-digit",
            hour12: false,
        },
        buttonText: {
            today: "Today",
            month: "Month",
            week: "Week",
            day: "Day",
            list: "List",
        },
        views: {
            dayGridMonth: {
                dayMaxEventRows: 4,
                dayHeaderFormat: { weekday: "short", day: "numeric" },
            },
            timeGridWeek: {
                dayHeaderFormat: { weekday: "short", day: "numeric" },
                slotMinTime: "08:00:00",
                slotMaxTime: "20:00:00",
            },
            timeGridDay: {
                dayHeaderFormat: {
                    weekday: "long",
                    month: "long",
                    day: "numeric",
                    year: "numeric",
                },
                slotMinTime: "08:00:00",
                slotMaxTime: "20:00:00",
            },
            listWeek: {
                listDayFormat: { weekday: "long" },
                listDaySideFormat: { day: "numeric", month: "long" },
            },
        },
        // Event fetching
        events: async function (fetchInfo, successCallback, failureCallback) {
            try {
                const response = await fetch("/api/appointments", {
                    method: "GET",
                    headers: {
                        Accept: "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN":
                            document.querySelector('meta[name="csrf-token"]')
                                ?.content || "",
                    },
                    credentials: "same-origin",
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const events = await response.json();

                // Ensure events is an array
                const normalizedEvents = Array.isArray(events)
                    ? events
                    : events.data || [];

                // Transform events to FullCalendar's expected format if needed
                const formattedEvents = normalizedEvents.map((event) => ({
                    id: event.id,
                    title:
                        event.title ||
                        `${event.pet?.name || "Pet"} - ${
                            event.type || "Appointment"
                        }`,
                    start: event.start_time || event.start,
                    end: event.end_time || event.end,
                    allDay: event.all_day || false,
                    extendedProps: {
                        status: event.status || "scheduled",
                        description: event.notes || "",
                        pet: event.pet,
                        owner: event.pet?.owner,
                        veterinarian: event.veterinarian,
                    },
                    url: event.url || `#`,
                }));

                successCallback(formattedEvents);
            } catch (error) {
                console.error("Failed to load events:", error);
                const errorEl = document.getElementById("calendar-error");
                const messageEl = document.getElementById(
                    "calendar-error-message"
                );
                if (errorEl && messageEl) {
                    messageEl.textContent =
                        error.message ||
                        "Failed to load calendar events. Please try again later.";
                    errorEl.classList.remove("hidden");
                }
                failureCallback(error);
            }
        },
        // Event rendering
        eventContent: function (arg) {
            const event = arg.event;
            const status = event.extendedProps.status || "scheduled";
            const isPast = event.end < new Date();

            // Create event container
            const eventEl = document.createElement("div");
            eventEl.className = `fc-event-inner fc-event-${status} ${
                isPast ? "opacity-70" : ""
            }`;

            // Create time element
            const timeEl = document.createElement("div");
            timeEl.className = "fc-event-time text-xs font-medium mb-1";

            if (event.allDay) {
                timeEl.textContent = "All day";
            } else if (event.start) {
                const startTime = event.start.toLocaleTimeString([], {
                    hour: "2-digit",
                    minute: "2-digit",
                });
                const endTime = event.end
                    ? event.end.toLocaleTimeString([], {
                          hour: "2-digit",
                          minute: "2-digit",
                      })
                    : "";
                timeEl.textContent = `${startTime}${
                    endTime ? ` - ${endTime}` : ""
                }`;
            }

            // Create title element
            const titleEl = document.createElement("div");
            titleEl.className = "fc-event-title text-sm font-medium";
            titleEl.textContent = event.title || "Appointment";

            // Add pet name if available
            if (event.extendedProps.pet?.name) {
                const petEl = document.createElement("div");
                petEl.className = "fc-event-pet text-xs mt-1 flex items-center";
                petEl.innerHTML = `
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0111-3.5M19 21v-1a6 6 0 00-4-5.659M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    ${event.extendedProps.pet.name}
                `;
                eventEl.appendChild(timeEl);
                eventEl.appendChild(titleEl);
                eventEl.appendChild(petEl);
            } else {
                eventEl.appendChild(timeEl);
                eventEl.appendChild(titleEl);
            }

            return { domNodes: [eventEl] };
        },
        // Event click handler
        eventClick: function (info) {
            info.jsEvent.preventDefault();

            // Show event details in a modal or navigate to the event
            if (info.event.url) {
                window.location.href = info.event.url;
            }
        },
        // Date click handler
        dateClick: function (info) {
            // Handle date click (e.g., create new event)
            const createUrl =
                document.getElementById("calendar")?.dataset.createUrl;
            if (createUrl) {
                window.location.href = `${createUrl}?date=${info.dateStr}`;
            }
        },
        // Loading state
        loading: function (isLoading) {
            const loadingEl = document.getElementById("calendar-loading");
            if (loadingEl) {
                if (isLoading) {
                    loadingEl.classList.remove(
                        "opacity-0",
                        "pointer-events-none"
                    );
                    loadingEl.classList.add("opacity-100");
                } else {
                    loadingEl.classList.remove("opacity-100");
                    loadingEl.classList.add("opacity-0", "pointer-events-none");
                }
            }
        },
        // Event render hook for custom styling
        eventDidMount: function (info) {
            // Add status-based classes
            const status = info.event.extendedProps.status || "scheduled";
            info.el.classList.add(`event-${status.toLowerCase()}`);

            // Add tooltip if description exists
            if (info.event.extendedProps.description) {
                info.el.setAttribute(
                    "title",
                    info.event.extendedProps.description
                );
                info.el.classList.add("cursor-help");
            }
        },
    });

    // Render the calendar
    calendar.render();

    // Handle window resize
    let resizeTimer;
    window.addEventListener("resize", function () {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function () {
            calendar.updateSize();
        }, 250);
    });

    // Expose calendar instance for debugging
    window.calendar = calendar;
};

// Initialize calendar when DOM is loaded
document.addEventListener("DOMContentLoaded", function () {
    // Check if we're on a page with a calendar that DOESN'T already have an instance
    if (document.getElementById("calendar") && !window.calendar) {
        initCalendar();
    }
});
