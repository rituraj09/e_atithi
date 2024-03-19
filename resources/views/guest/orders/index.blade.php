<!-- resources/views/guestHouse/GuestHouse/view.blade.php -->

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-guest.guest-navbar/>

            <div class="page-content" style="background-color: #f1fcff">
                <x-page-header :title="'My Orders'" />
                    <div class="d-flex flex-column border card p-2">
                        <div class="responsive-table">
                            <table class="table" id="dataTableExample">
                                <thead>
                                    <tr>
                                        <th>Guest House</th>
                                        <th>Reservation No</th>
                                        <th>Location</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   @foreach ($orders as $order)
                                       <tr class="text-capitalize text-truncate">
                                            <td>{{ $order->guestHouse->name }}</td>
                                            <td>{{ $order->reservation_no }}</td>
                                            <td>{{ $order->guestHouse->district_name->name }}</td>
                                            <td>{{ $order->created_at }}</td>
                                            <td>{{ $order->getStatus->name }}</td>
                                       </tr>
                                   @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom js for this page -->
    <script>
    $(document).ready(function () {

    });
    </script>

<x-main-footer/>
