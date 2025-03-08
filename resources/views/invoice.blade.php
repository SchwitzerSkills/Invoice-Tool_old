<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fleckviehbetrieb - Rechnungen</title>
    <link rel="stylesheet" href="{{ url('css/header/style.css') }}">
    <link rel="stylesheet" href="{{ url('css/invoice/style.css') }}">
</head>
<body>
    <header>
        <div>
            <img src="{{ url('img/Logo.png') }}" width="250" alt="Logo">
        </div>
        <div>
            <p>Rechnungen</p>
        </div>
        <div class="adminControl">
            <div class="adminBtn">
                <p><a href="{{ url('admin') }}">Admin</a></p>
            </div>
            <div class="invoice_create">
                <form action="{{ url('invoice/create') }}">
                    <button>Rechnung erstellen</button>
                </form>
            </div>
        </div>
    </header>
    <div class="container">
        <div class="wrapper">
            <div class="invoices">
                <div>
                    @foreach($invoices as $invoice)
                    <div>
                        <label>Rechnung #: {{ $invoice->id }}<br>
                            {{ $invoice->customerName }}<br>
                            {{ $invoice->invoiceDate }}<br>
                            <a href="{{ url('invoice/get/'.$invoice->id) }}"><img src="{{ url('img/invoice.png') }}" alt="Rechnung-{{ $invoice->id }}" width="150"></a>
                        </label>
                    </div>

                    @endforeach
                </div>
            </div>
        </div>
    </div>
</body>
</html>