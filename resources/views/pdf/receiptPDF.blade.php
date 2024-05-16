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
    <title>Guest House Bill - T23-00-23</title>
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
            margin-bottom: 20px;
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
        <h1 style="font-size: 18px; font-weight:600; text-align:center;">Receipt No: R23-00-23</h1>
    </div>
    <div class="header">
        <h1 style="width: 100%">GH11</h1>
        <p>Golaghat, Assam</p>
        <p>+91 98765 43210</p>
        <p>contact@email.com</p>
    </div>

    <div>
        <table style="max-width: 800px; margin: 0px auto;">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Room Number</th>
                    <th>Rate</th>
                    <th>Nights</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>101</td>
                    <td>100</td>
                    <td>3</td>
                    <td>100/-</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>102</td>
                    <td>100</td>
                    <td>3</td>
                    <td>100/-</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" style="font-weight: 600">
                        Subtotal
                    </td>
                    <td>700/-</td>
                </tr>
                <tr>
                    <td colspan="4" style="font-weight: 600">
                        Total
                    </td>
                    <td>700/-</td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="guest-details">
        <h3>Guest Details</h3>
        <table>
            <tr>
                <th>Reservation ID</th>
                <td>0022-AS-202333</td>
            </tr>
            <tr>
                <th>Check-in Date</th>
                <td>12/03/2002</td>
            </tr>
            <tr>
                <th>Check-out Date</th>
                <td>23/03/2024</td>
            </tr>
            {{-- usng [0] index because all are under same transaction --}}
        </table>
    </div>

    
    <hr>
    <div class="bill-to">
        <h1>Receipt To,</h1>
        <p>Gaurab Gogoi</p>
        <p>+91 98765 43210</p>
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
