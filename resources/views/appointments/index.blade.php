<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
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
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },

                events: [
                        @foreach($appointments as $appointment)
                    {
                        title: 'title',
                        start: '{{$appointment->date}}T{{$appointment->time}}'
                    },
                        @endforeach
                    {
                        start: '2024-03-09T08:00:00',
                        end: '2024-03-09T16:00:00',
                        display: 'background'
                    },
                    {
                        start: '2024-03-10T08:00:00',
                        end: '2024-03-10T16:00:00',
                        display: 'background'
                    }
                ],
                eventTimeFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: false
                }
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


