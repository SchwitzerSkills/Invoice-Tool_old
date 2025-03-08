<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fleckviehbetrieb - Login</title>
    <link rel="stylesheet" href="{{ url('css/header/style.css') }}">
    <link rel="stylesheet" href="{{ url('css/login/style.css') }}">
</head>
<body>
    <header>
        <div>
            <img src="{{ url('img/Logo.png') }}" width="250" alt="Logo">
        </div>
        <div>
            <p>Login</p>
        </div>
        <div>
            <p>testr</p>
        </div>
    </header>
    <div class="container">
        <div class="wrapper">
            <div class="loginContainer">
                <form method="post" action="{{ url('login/auth') }}">
                    @csrf
                    <div>
                        <div>
                            <h1>Login</h1>
                        </div>
                        <div>
                            <p class="status">{{ session("error_message") }}</p>
                        </div>
                        <div>
                            <input id="usernameInput" name="usernameInput" type="text" placeholder="Username">
                        </div>
                        <div>
                            <input id="passwordInput" name="passwordInput" type="password" placeholder="Passwort">
                        </div>
                        <div>
                            <button>Anmelden</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>