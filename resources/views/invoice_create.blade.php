<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fleckviehbetrieb - Rechnung erstellen</title>
    <link rel="stylesheet" href="{{ url('css/header/style.css') }}">
    <link rel="stylesheet" href="{{ url('css/invoice_create/style.css') }}">
    <script src="https://unpkg.com/jspdf-invoice-template@latest/dist/index.js" type="text/javascript"></script>
    <script src="https://unpkg.com/moment@2.29.4/min/moment.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        <!-- <div class="test_invoice_hp">
                <button id="hp_invoice">Rechnung HP erstellen</button>
        </div> -->
    </header>
    <div class="container">
        <div class="wrapper">
            <div>
                <div>
                    <div>
                        <div>
                            <label>Firma: <br>
                            <select name="companySelector" id="companySelector">
                                <option value="fleckviehbetrieb">Fleckviehbetrieb</option>
                                <option value="hp-forst">HP-Forst</option>
                            </select>
                            </label>
                        </div>
                        <label>Rechnungsnummer: <br>
                            <input id="invoiceNumber" name="invoiceNumber" type="text" value="{{ $count }}" disabled>
                        </label>
                        </div>
                        <div>
                            <label>Namen des Kunden: <br>
                                <input id="customerName" name="customerName" type="text">
                            </label>
                        </div>
                        <div>
                            <label>Adresse (Land, Straße + Hausnummer, Ort): <br>
                                <input id="customerAddress" name="customerAddress" type="text">
                            </label>
                        </div>
                        <div>
                            <label>Telefonnummer, Email oder UID-Nummer: <br>
                                <input id="customerInfos" name="customerInfos" type="text">
                            </label>
                        </div>
                        <div>
                            <label>Direkt Beleg an den Kunden schicken?: <br>
                                <input id="sendEmailToCustomer" name="sendEmailToCustomer" type="checkbox">
                            </label>
                        </div>
                        <div>
                            <label>Rechnung muss bezahlt werden bis: <br>
                                <input id="payUntil" name="payUntil" type="date">
                            </label>
                        </div>
                        <div>
                            <label>Mehrwertsteuer: <br>
                                <input id="tax" name="tax" type="number">
                            </label>
                        </div>
                        <div class="service">
                            <label>Bestelltes Service:</label>
                            <div>
                                <button id="addService">+</button>
                            </div>
                            <div class="table-container">
                                <table border="1">
                                    <tr>
                                        <th>Beschreibung</th>
                                        <th>Preis</th>
                                        <th>Menge</th>
                                        <th>Einheit</th>
                                    </tr>
                                    <tbody id="serviceTable">
                                        <tr class="services-0">
                                            <td><input class="serviceDescription" id="serviceDescription-0" type="text"></td>
                                            <td><input class="servicePrice" id="servicePrice-0" type="number"></td>
                                            <td><input class="serviceQuantity" id="serviceQuantity-0" type="number"></td>
                                            <td><input class="serviceUnit" id="serviceUnit-0" type="text"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                <button id="invoice_create">Rechnung erstellen</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="{{ url('js/invoice_create/ALL.js') }}"></script>
</html>
