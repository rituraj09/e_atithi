{{-- {{ dd($hasTransactions); }} --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest House Receipt - {{ $receipt->receipt_no }}</title>
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
            margin-bottom: 20px;
            text-align: end;
        }

        .header h1 {
            font-size: 18px;
            margin: 0;
        }

        .header p {
            margin: 4px 0px;
        }

        .guest-details {
            max-width: 800px;
            margin: 2rem auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-top: 2px solid #001058;
            border-bottom: 2px solid #001058;
        }

        th, td {
            border: 1px solid rgb(226, 226, 226);
            /* border-top: 2px solid #001058; */
            padding: 8px;
        }

        th {
            text-align: left;
            border-bottom: 2px solid #001058;
        }

        table tbody tr td:first-child {
            font-weight: 600;
        }

        table tfoot tr {
            border-top: 2px solid #001058;
        }

        .guest-details table, .guest-details th, .guest-details td {
            border: none;
        }

        .bill-to h1 {
            font-size: 20px;
            font-weight: 700;
        }

        .bill-to p {
            margin: 6px 0px;
        }

        .footer {
            padding-top: 20px;
            margin-top: auto !important;
            margin-bottom: .5rem !important;
        }

        .footer div {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <div>
        <h1 style="font-weight: 800; font-size: 30px; width: 100%; text-align: center; background: rgb(221, 221, 221); padding: 10px 0px;">
            Receipt
        </h1>
        <hr>
        <h1 style="font-size: 18px; font-weight:600; text-align:center;">Receipt No: {{ $receipt->receipt_no }}</h1>
    </div>
    <div class="header">
        <h1 style="width: 100%">{{ $guestHouse->name }}</h1>
        <p>{{ $guestHouse->district_name->name }}, {{ $guestHouse->state_name->name }}</p>
        <p>+91 {{ $guestHouse->contact_no }}</p>
        <p>{{ $guestHouse->official_email }}</p>
    </div>

    <div>
        <table style="max-width: 800px; margin: 0px auto;">
            <thead>
                <tr>
                    <th>Room Number</th>
                    <th>Rate</th>
                    <th>Nights</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hasTransactions as $transaction)
                    <tr>
                        <td>{{ $transaction->reservedRooms->roomDetails->room_number }}</td>
                        <td>{{ $transaction->reservedRooms->roomDetails->total_price }}</td>
                        <td>{{ $transaction->days }}</td>
                        <td>{{ $transaction->totalCost }}.00/-</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" style="font-weight: 600">
                        Subtotal
                    </td>
                    <td>{{ $receipt->amount }}/-</td>
                </tr>
                <tr>
                    <td colspan="3" style="font-weight: 600">
                        Total
                    </td>
                    <td>{{ $receipt->amount }}/-</td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="guest-details">
        <h3>Guest Details</h3>
        <table style="width: auto !important;">
            <tr>
                <th>Reservation ID</th>
                <td> : </td>
                <td>{{ $reservation->reservation_no }}</td>
            </tr>
            <tr>
                <th>Check-in Date</th>
                <td> : </td>
                <td>{{ $hasTransactions[0]->checked_in_date }}</td>
            </tr>
            <tr>
                <th>Check-out Date</th>
                <td> : </td>
                <td>{{ $hasTransactions[0]->checked_out_date }}</td>
            </tr>
            {{-- usng [0] index because all are under same transaction --}}
        </table>
    </div>

    
    <hr>
    <div class="bill-to">
        <h1>Receipt To,</h1>
        <p>{{ $guest->name }}</p>
        <p>+91 {{ $guest->phone }}</p>
    </div>
    
    <div class="footer">
        <hr>
        <div>
            <div class="left">
                <span>&copy; NIC, Assam</span>
            </div>
            <div class="right">
                <span>eAtithi</span>
            </div>
        </div>
    </div>
    {{-- <script src="{{ asset('assets/vendors/core/core.js') }}"></script> --}}
</body>
</html>
