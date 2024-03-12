document.addEventListener('DOMContentLoaded', function () {

    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        timeZone: 'Europe/Budapest',
        locale: 'hu',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        eventSources: [
            '/getAppointments',
            '/getOpeningHours'
        ],

        dateClick: function(info) {
            calendar.changeView('timeGridDay', info.dateStr);
        },
        selectable:true,
        selectConstraint: 'openingHours',
        select: function(info) {
            if (info.view.type === 'timeGridDay') {
                var username = window.prompt('Enter name: ', '');
                $.ajax({
                    url: '/',
                    type: 'POST',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {
                        start: info.startStr,
                        end: info.endStr,
                        username: username
                    },
                    success: function(response) {
                        console.log('Appointment saved: ', response, info.startStr, info.endStr, username);
                        calendar.refetchEvents();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error saving appointment: ', error);
                    }
                })
            }
        },
        eventTimeFormat: {
            hour: '2-digit',
            minute: '2-digit',
            hour12: false
        },
    });
    calendar.render();
});
