<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fleckviehbetrieb - Dashboard</title>
    <link rel="stylesheet" href="{{ url('css/header/style.css') }}">
    <link rel="stylesheet" href="{{ url('css/dashboard/style.css') }}">
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
    <div class="container">
        <div class="wrapper">
            <div class="loginContainer">
                <div>
                    <div>
                        <label>Handys: <br>
                            <a href="{{ url('handys') }}"><img src="{{ url('img/handys.jpg') }}" alt="Handys" width="150"></a>
                        </label>
                    </div>
                    <div>
                        <label>Kalendar: <br>
                            <a href="{{ url('calendar') }}"><img src="{{ url('img/calendar.png') }}" alt="Handys" width="150"></a>
                        </label>
                    </div>
                    <div>
                        <label>Rechnungen: <br>
                            <a href="{{ url('invoice') }}"><img src="{{ url('img/invoice.png') }}" alt="Handys" width="150"></a>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>