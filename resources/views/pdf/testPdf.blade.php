{{-- <!DOCTYPE html>
<html>
<head>
    <title>Laravel 10 Generate PDF From View</title>
</head>
<body>
    <h1>{{ $title }}</h1>
    <p>{{ $date }}</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
</body>
</html> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest House Bill - {{ $bill->bill_no }}</title>
    {{-- <link rel="stylesheet" href="{{ asset('css/my-style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/demo1/style.css')}}">

	<link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}"> --}}
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 20px;
            margin: 0;
        }

        .guest-details {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: none;
            border-top: 2px solid #001058;
            padding: 8px;
        }

        th {
            text-align: left;
        }

        .footer {
            margin-top: auto !important;
            margin-bottom: .5rem !important;
        }
    </style>
</head>
<body>
    <div class="header">
        <h4>eAtithi</h4>
        <h1>{{ $guestHouse->name }}</h1>
        <p>Bill No: {{ $bill->bill_no }}</p>
    </div>

    <div class="d-flex">
        <div class="col">

        </div>
        <div class="col text-end">
            <p class="fs-3 fw-bolder">{{ $guestHouse->name }}</p>
            <p class="text-darkgray fs-5">{{ $guestHouse->district_name->name }}, {{ $guestHouse->state_name->name }}</p>
            <div class="d-flex mt-2 justify-content-end">
                <p class="pe-2">{{ $guestHouse->contact_no }}</p>
                <span class="mdi mdi-phone"></span>
            </div>
            <div class="d-flex justify-content-end">
                <span class="pe-2">{{ $guestHouse->official_email }}</span>
                <span class="mdi mdi-at"></span>
            </div>
        </div>
    </div>

    <div class="guest-details">
        <h3>Guest Details</h3>
        <table>
            <tr>
                <th>Guest Name</th>
                <td>{{ $guest->name }}</td>
            </tr>
            <tr>
                <th>Reservation ID</th>
                <td>{{ $reservation->reservation_no }}</td>
            </tr>
            <tr>
                <th>Check-in Date</th>
                <td>{{ $hasTransactions[0]->checked_in_date }}</td>
            </tr>
            <tr>
                <th>Check-out Date</th>
                <td>{{ $hasTransactions[0]->checked_out_date }}</td>
            </tr>
            {{-- usng [0] index because all are under same transaction --}}
        </table>
    </div>

    <div class="room-charges">
        <h3>Room Charges</h3>
        <table>
            <thead>
                <tr>
                    <th>Room</th>
                    <th>Rate</th>
                    <th>Nights</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hasTransactions as $transaction)
                <tr>
                    <td>{{ $transaction->reservedRooms->roomDetails->room_number }}</td>
                    <td>{{ number_format($transaction->reservedRooms->roomDetails->total_price, 2) }}</td>
                    <td>{{ $transaction->days }}</td>
                    <td>{{ $transaction->totalCost }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="total-bill">
        <h3>Total Bill</h3>
        <table width="50%">
            <tr>
                <th>Subtotal</th>
                <td>{{ number_format($bill->amount, 2) }}</td>
            </tr>
            <tr>
                <th>Total</th>
                <td>{{ number_format($bill->amount, 2) }}</td>
            </tr>
        </table>
    </div>
    <div class="footer">
        <hr>
        <div class="d-flex">
            <div class="col">
                <span>&copy; NIC, Assam</span>
            </div>
            <div class="col text-end">
                <span>eAtithi</span>
            </div>
        </div>
    </div>
    {{-- <script src="{{ asset('assets/vendors/core/core.js') }}"></script> --}}
</body>
</html>
