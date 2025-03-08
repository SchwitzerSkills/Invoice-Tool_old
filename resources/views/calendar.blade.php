<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fleckviehbetrieb - Kalendar</title>
    <link rel="stylesheet" href="{{ url('css/header/style.css') }}">
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
</head>
<body>
    
    <header>
        <div>
            <img src="{{ url('img/Logo.png') }}" width="250" alt="Logo">
        </div>
        <div>
            <p>Dashboard</p>
        </div>
        <div>
            <p><a href="{{ url('admin') }}">Admin</a></p>
        </div>
    </header>
    <div id='calendar'></div>
</body>
<script src="{{ url('js/calendar/ALL.js') }}"></script>
</html>