document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        timeZone: 'Europe/Budapest',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        selectable:true,

        events: {
            url: '/getAppointments',
            method: 'GET',
            failure: function() {
                alert('There was an error fetching appointments!');
            }
        },
        dateClick: function(info) {
            calendar.changeView('timeGridDay', info.dateStr);
        },
        select: function(info) {
            if (info.view.type === 'timeGridDay') {
                var name = window.prompt('Enter name: ', '');
                $.ajax({
                    url: '/',
                    type: 'POST',
                    data: {
                        date: info.startStr,
                        name: name,
                        _token: '{{csrf_token()}}'
                    },
                    success: function(response) {
                        console.log('Appointment saved: ', response, info.startStr, name);
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
