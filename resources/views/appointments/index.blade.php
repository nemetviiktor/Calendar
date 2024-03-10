<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
    <script src="{{ asset('js/calendar.js') }}" defer></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Appointments</title>
</head>
<body>

<div id='calendar'></div>

</body>
</html>


