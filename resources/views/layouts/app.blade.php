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




        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: [
                    {
                        title: 'title',
                        start: {{ $appointment->date }}
                    },
                    {
                        title: 'All Day Event',
                        start: '2024-02-01'
                    },
                    {
                        title: 'Long Event',
                        start: '2024-02-07',
                        end: '2024-02-10'
                    },
                    {
                        groupId: '999',
                        title: 'Repeating Event',
                        start: '2024-02-09T16:00:00'
                    },
                    {
                        groupId: '999',
                        title: 'Repeating Event',
                        start: '2024-02-16T16:00:00'
                    },
                    {
                        title: 'Conference',
                        start: '2024-02-11',
                        end: '2024-02-13'
                    },
                    {
                        title: 'Meeting',
                        start: '2024-02-12T10:30:00',
                        end: '2024-02-12T12:30:00'
                    },
                    {
                        title: 'Lunch',
                        start: '2024-02-12T12:00:00'
                    },
                    {
                        title: 'Meeting',
                        start: '2024-02-12T14:30:00'
                    },
                    {
                        title: 'Birthday Party',
                        start: '2024-02-13T07:00:00'
                    },
                    {
                        title: 'Click for Google',
                        url: 'https://google.com/',
                        start: '2024-02-28'
                    }
                ]
            });

            calendar.render();
        });



    </script>
    <!--script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth'
            });
            calendar.render();
        });
    </script!-->


</head>
<body>

<div class="container">
    @yield('content')
</div>

@yield('footer')

</body>
</html>
