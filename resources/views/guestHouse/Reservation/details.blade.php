<!-- resources/views/guestHouse/GuestHouse/add.blade.php -->

{{-- {{ dd($reservation); }} --}}

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-admin.navbar/>

            <div class="page-content">
                <x-page-header :prev="'Manage Reservations'" :title="'Details'"/>
                <div class="card d-flex flex-column border">
                    <div class="d-flex col nav nav-tabs bg-light pt-2 px-2">
                        <div>
                            <a href="{{ route('all-reservations') }}" class="text-capitalize nav-link">
                                view
                            </a>
                        </div>
                        <div>
                            <button class="text-capitalize nav-link active px-4 fw-bold">
                                details
                            </button>
                        </div>
                    </div>
                    <div class="row m-0 p-3 fs-5">
                        <div class="col-md-4 mb-3">
                            <b class="fw-bolder mb-1 ">Reservation No</b>
                            <input id="reservationNo" class="text-darkgray border-0" value="{{ $reservation->reservation_no }}" readonly disabled>
                            <input type="hidden" value="{{ $reservation->id }}" id="reservationId">
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="fw-bolder mb-1 ">Guest Name</div>
                            <div class="text-darkgray">{{ $reservation->guest->name }}</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="fw-bolder mb-1 ">Reservation Type</div>
                            <div class="text-darkgray">{{ $reservation->reservation_no }}</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="fw-bolder mb-1 ">Checkin Date</div>
                            <div class="text-darkgray">{{ $reservation->check_in_date }}</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="fw-bolder mb-1 ">Checkout Date</div>
                            <div class="text-darkgray">{{ $reservation->check_out_date }}</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="fw-bolder mb-1 ">Amount</div>
                            <div class="text-darkgray">700/- <span class="badge bg-success ms-2"><small>Paid</small></span></div>
                        </div>
                        <div class="col-12 mb-3 mt-3">
                            <p class="fw-bolder mb-1 ">Current Status</p>
                            <div id="statusMessage" class="text-darkgray">{{ $reservation->getStatus->name }}</div>
                            <input type="hidden" id="status" value="{{ $reservation->status }}">
                            <div id="approverContainer" class="d-flex flex-wrap justify-content-between p-1 mt-3">
                                <div class="col">
                                    <button class="btn btn-sm btn-primary wd-200 fw-bolder" id="approve">
                                        Approve
                                    </button>
                                </div>
                                <div class="col">
                                    <button class="btn btn-sm btn-danger wd-200 fw-bolder">
                                        Reject
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row m-0">
                        <div class="mb-3 col-lg-9 col-md-10 mx-auto">
                            <table class="table table-hover border text-capitalize" id="room-table">
                                <thead>
                                  <tr>
                                    <th class="text-darkgray">Room</th>
                                    <th class="text-darkgray">Category</th>
                                    <th class="text-darkgray">Rate</th>
                                    <th class="text-darkgray">Status</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  @foreach ($rooms as $room)
                                    <tr data-id="{{ $room->id }}" class="cursor">
                                      <td>{{ $room->roomDetails->room_number }}</td>
                                      <td>{{ $room->roomDetails->roomRate->roomCategory->name }}</td>
                                      <td>{{ $room->roomDetails->roomRate->price }}</td>
                                      <td>Pending</td>
                                    </tr>
                                  @endforeach
                                </tbody>
                                <tfoot id="transactionBody">
                                  <tr>
                                    <td colspan="3"></td>
                                    <td class="p-1">
                                      <button type="button" class="ms-auto me-0 btn btn-success py-1" id="checkin-button">
                                        Checkin
                                      </button>
                                    </td>
                                  </tr>
                                </tfoot>
                              </table>
                        </div>
                    </div>
                    <div class="row m-0 mt-2 mb-3 p-3 fs-5">
                        <div class="col-12 mb-3 fw-bold">
                            Aditional Information
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="fw-bolder mb-3">
                                Remarks
                            </div>
                            <div class="text-darkgray mb-3">
                                {{ $reservation->remarks }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-footer/>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        const status = $('#status').val();
        if ( status === '1' || status === 1 ) {
            $('#statusMessage').addClass('text-primary');
            $('#transactionBody').hide();
        } else if ( status === '2' || status === '4' || status === '11' || status === '12' || status === '13' || status === '14' ) {
            $('#statusMessage').addClass('text-danger');
            $('#transactionBody').hide();
            $('#approverContainer').addClass('d-none');
            $('#approve').hide();
            console.log('s')
        } else if ( status === '8' || status === 8 ) {
            $('#statusMessage').addClass('text-secondary');
        } else {
            $('#statusMessage').addClass('text-success');
            $('#approverContainer').hide();
            $('#approve').parent().hide();
        }
    
    });

    $(document).on('click', '#approve', function () {
        const id = $('#reservationId').val();
        const reservationNo = $('#reservationNo').val();
        $.ajax({
            url: "{{ route('approve-reservation') }}",
            type: "POST",
            data: {
                id:id,
                reservationNo:reservationNo
            },
            success: function (res) {
                console.log(res);
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false, 
                    timer: 3000,
                    timerProgressBar: true,
                });
                if (res === 'success') {
                    Toast = Swal.mixin({
                        title: "Reservation approved",
                        icon: "success"
                    });
                    setTimeout(() => {
                        window.location.reload();
                    }, 500);
                } else {
                    Toast = Swal.mixin({
                        title: "Something went wrong",
                        text: "Please try again",
                        icon: "error"
                    });
                }
                Toast.fire();
            }
        });
    });

    $(document).ready(function () {
        // Function to handle row selection
        function toggleRowSelection(row) {
        $(row).toggleClass('table-active');
        }

        // Function to store selected rows in an array
        function storeSelectedRows() {
        const selectedRows = $('#room-table tbody tr.selected');
        const selectedData = selectedRows.map(function() {
            const id = $(this).data('id');
            // const room = $(this).data('room');
            // return { id, room, category, rate, status };
            return id;
        }).get();
        return selectedData;
        }

        // Function to handle submission
        function handleSubmit() {
            const selectedData = storeSelectedRows();
            console.log('Submitted data:', selectedData);
        }

        // Add event listener to the checkin button
        $('#checkin-button').click(handleSubmit);

        // Add event listener to each row for selection toggle
        $('#room-table tbody tr').click(function() {
            toggleRowSelection(this);
        });
    });

    </script>

<x-main-footer/>
