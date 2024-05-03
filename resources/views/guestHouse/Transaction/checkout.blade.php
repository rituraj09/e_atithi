<!-- resources/views/guestHouse/Transaction/index.blade.php -->

{{-- {{ dd($roomTransactions); }} --}}

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-admin.navbar/>

            <div class="page-content">
                <x-page-header :prev="'Manage Transactions'" :title="'Check Out Rooms'" />
                <div class="d-flex flex-column border card">
                    <div class="col nav nav-tabs bg-light pt-2 px-2">
                        <div>
                            <a href="{{ route('transaction') }}" class="text-capitalize nav-link">
                                view
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('check-in-view') }}" class="text-capitalize nav-link">
                                Check in
                            </a>
                        </div>
                        <div>
                            <button class="text-capitalize nav-link active px-4 fw-bold">
                                Check out
                            </button>
                        </div>
                    </div>
                    <div class="row p-3">
                        <div class="col-md-8 mx-auto my-4">
                            <form action="" method="post">
                                <div class="input-group mb-5">
                                    <input type="text" class="form-control" name="reservation_no" 
                                    @if (isset($reservation_no))
                                        value="{{ $reservation_no }}"
                                    @endif
                                    placeholder="Reservation No">
                                    <button class="btn btn-primary" type="submit">Search</button>
                                </div>
                            </form>
                            @if (isset($reservation))
                                <div class="row mb-3">
                                    <div class="">
                                        <p class="fw-bold mb-1">Check In Date:  <span class="fw-medium text-darkgray">{{ $reservation->check_in_date }}</span></p>
                                        <p class="fw-bold mb-1">Check Out Date: <span class="fw-medium text-darkgray">{{ $reservation->check_out_date }}</span></p>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Room number</th>
                                                <th>Room Category</th>
                                                <th>Rate</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($rooms as $room)
                                                <tr class="cursor">
                                                    <td>{{ $room->roomDetails->room_number }}</td>
                                                    <td>{{ $room->roomDetails->roomCategory->name }}, {{ $room->roomDetails->bedType[0]->name }}</td>
                                                    <td>{{ $room->roomDetails->total_price }}</td>
                                                    <td><input type="checkbox" name="" id=""></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex justify-content-end mb-3">
                                    <button class="btn btn-success">Check in</button>
                                </div>
                                <div class="mb-3">
                                    <div class="mb-2">
                                        <p class="fs-4 fw-bold">Guest Info</p>
                                    </div>
                                    <div class="mb-2">
                                        <b>Name</b><span class="ps-3 text-capitalize">{{ $guest->name }}</span>
                                    </div>
                                    <div class="mb-2">
                                        <b>Email</b><span class="ps-3 text-capitalize">{{ $guest->email }}</span>
                                    </div>
                                    <div class="mb-2">
                                        <b>Phone No</b><span class="ps-3 text-capitalize">{{ $guest->phone }}</span>
                                    </div>
                                </div>
                            @endif
                        </div>
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