<!-- resources/views/guestHouse/Transaction/index.blade.php -->

{{-- {{ dd($roomTransactions); }} --}}

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-admin.navbar/>

            <div class="page-content">
                <x-page-header :title="'Manage Transactions'"/>
                <div class="d-flex flex-column border card">
                    <div class="col nav nav-tabs bg-light pt-2 px-2">
                        <div>
                            <button class="text-capitalize nav-link active px-4 fw-bold">
                                view
                            </button>
                        </div>
                        <div>
                            <a href="{{ route('check-in-view') }}" class="text-capitalize nav-link">
                                Check in
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('check-out-view') }}" class="text-capitalize nav-link">
                                Check out
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        {{-- data from room transactions only --}}
                        {{-- <div class="table-responsive">
                            <table id="dataTableExample">
                                <thead>
                                    <tr>
                                    <th>Transaction No</th>
                                    <th>Reservation No</th>
                                    <th>Guest Name</th>
                                    <th>Room Number</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roomTransactions as $roomTransaction)
                                    <tr>
                                        <td>{{ $roomTransaction->transaction_id }}</td>
                                        <td>{{ $roomTransaction->reservation_no }}</td>
                                        <td>{{ $roomTransaction->reservationDetails->guest->name }}</td>
                                        <td>{{ $roomTransaction->reservedRooms->roomDetails->room_number }}</td>
                                        <td>{{ $roomTransaction->reservationDetails->getStatus->name }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> --}}
                        <table id="example" class="table">
                            <thead>
                                <tr>
                                    <th>Transaction No</th>
                                    <th>Reservation No</th>
                                    <th>Guest Name</th>
                                    <th>Room Number</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roomTransactions as $roomTransaction)
                                    <tr>
                                        <td>{{ $roomTransaction->transaction_id }}</td>
                                        <td>{{ $roomTransaction->reservationDetails->reservation_no }}</td>
                                        <td>{{ $roomTransaction->reservationDetails->guest->name }}</td>
                                        <td>{{ $roomTransaction->reservedRooms->roomDetails->room_number }}</td>
                                        <td>{{ $roomTransaction->reservationDetails->getStatus->name }}</td>
                                        <td>
                                            <a href="{{ route('check-in-view',['id' => $roomTransaction->reservationDetails->reservation_no]) }}" class="btn btn-info me-1">check in</a>
                                            <a href="{{ route('check-out-view', ['id' => $roomTransaction->reservationDetails->reservation_no]) }}" class="btn btn-warning me-1">check out</a>
                                        </td>
                                    </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <x-footer/>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function () {
        $('#search').on('click', function () {
            const rid = $('#reservation_id').val();

            $.ajax({
                url: "{{ url('ajax/fetchReservation') }}/" + rid,
                type: "GET",
                success: function (res) {
                    console.log(res);
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });


    </script>

<x-main-footer/>