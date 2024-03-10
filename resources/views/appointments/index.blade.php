<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <title>Appointments</title>
    <style>
        html, body {
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
            font-size: 14px;
        }

        #calendar {
            max-width: 1100px;
            margin: 40px auto;
        }
    </style>
    <script>
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
                        $.ajax({
                            url: '/',
                            type: 'POST',
                            data: {
                                date: info.startStr,
                                _token: '{{csrf_token()}}'
                            },
                            success: function(response) {
                                console.log('Appointment saved: ', response, info.startStr);
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
    </script>
</head>
<body>
<div id='calendar'></div>


<form method="post" action="/">
    <input type="text" name="date" placeholder="Enter date"/>
    <input type="text" name="time" placeholder="Enter time"/>
    {{csrf_field()}}

    <input type="submit" name="submit"/>
</form>

</body>
</html>


