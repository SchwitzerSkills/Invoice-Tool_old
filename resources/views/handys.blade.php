<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fleckviehbetrieb - Handys</title>
    <link rel="stylesheet" href="{{ url('css/header/style.css') }}">
    <link rel="stylesheet" href="{{ url('css/handys/style.css') }}">
    <link rel="stylesheet" href="{{ url('css/modal/style.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <header>
        <div>
            <a href="{{ url('/') }}"><img src="{{ url('img/Logo.png') }}" width="250" alt="Logo"></a>
        </div>
        <div>
            <p>Handys</p>
        </div>
        <div>
            <p><a href="{{ url('admin') }}">Admin</a></p>
        </div>
    </header>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span id="closeModal" class="close">&times;</span>
            <form method="post" action="{{ url('image/save') }}" enctype="multipart/form-data">
                @csrf
                <div>
                    <h1>Handyvertrag</h1>
                </div>
                <div>
                    <img id="contract" src="{{ url('storage/images') }}" alt="Vertrag" width="225">
                </div>
                <div>
                    <input type="file" name="mobileContract" id="mobileContract" accept="image/png, image/jpeg">
                </div>
                <div>
                    <button name="handyOwner" id="handyOwner">Speichern</button>
                </div>
            </form>
        </div>
    </div>
    <div class="status">
        <p class="error_message">{{ session('error_message') }}</p>
        <p class="success_message">{{ session('success_message') }}</p>
    </div>
    <div class="container">
        <div class="wrapper">
            <div class="loginContainer">
                <div>
                    <div>
                        <label>Phillip (Samsung Galaxy A54S): <br>
                            <a data-handy="phillip" class="handyModal"><img src="{{ url('img/handys.jpg') }}" alt="Handys" width="150"></a>
                        </label>
                    </div>
                    <div>
                        <label>Helmut (Samsung Galaxy Cover 4): <br>
                            <a data-handy="helmut" class="handyModal"><img src="{{ url('img/samsung-galaxy-cover-4.png') }}" alt="Handys" width="180"></a>
                        </label>
                    </div>
                    <div>
                        <label>Lisa (Samsung Galaxy S21 FE): <br>
                            <a data-handy="lisa" class="handyModal"><img src="{{ url('img/samsung-galaxy-s21-fe.jpg') }}" alt="Handys" width="180"></a>
                        </label>
                    </div>
                    <div>
                        <label>Philipp (Samsung Galaxy S21 FE): <br>
                            <a data-handy="philipp" class="handyModal"><img src="{{ url('img/samsung-galaxy-s21-fe.jpg') }}" alt="Handys" width="180"></a>
                        </label>
                    </div>
                    <div>
                        <label>Carmen (Redmi Node): <br>
                            <a data-handy="carmen" class="handyModal"><img src="{{ url('img/samsung-galaxy-s21-fe.jpg') }}" alt="Handys" width="180"></a>
                        </label>
                    </div>
                    <div>
                        <label>Hildegard (Emporia S3): <br>
                            <a data-handy="hildegard" class="handyModal"><img src="{{ url('img/emporia-s3.jpeg') }}" alt="Handys" width="180"></a>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="{{ url('js/handys/ALL.js') }}"></script>
</html>