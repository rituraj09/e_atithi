<!-- resources/views/guestHouse/GuestHouse/add.blade.php -->

{{-- {{ dd($reservation, $rooms, $checked_in_rooms, $checked_out_rooms); }} --}}

{{-- <x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper"> --}}
            {{-- <x-admin.navbar/> --}}

            {{-- <div class="page-content">
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
                    </div> --}}
                    <div class="row m-0 p-3 fs-5">
                        <div class="col-md-4 mb-3">
                            <div class="fw-bolder mb-1 ">Reservation No</div>
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
                                    <button class="btn btn-sm btn-danger wd-200 fw-bolder" id="reject">
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
                                        @if (in_array($room->id, $checked_in_rooms))
                                            <tr class="text-secondary">
                                        @elseif (in_array($room->id, $checked_out_rooms))
                                            <tr>
                                        @else
                                            <tr data-id="{{ $room->id }}" class="cursor">
                                        @endif
                                        
                                            <td>{{ $room->roomDetails->room_number }}</td>
                                            <td>{{ $room->roomDetails->roomCategory->name }}</td>
                                            <td>{{ $room->roomDetails->total_price }}</td>
                                            <td>
                                                @if (in_array($room->id, $checked_in_rooms))
                                                    {{-- Room is checked in --}}
                                                    <span class="text-success">Checked in</span>
                                                @elseif (in_array($room->id, $checked_out_rooms))
                                                    {{-- Room is checked out --}}
                                                    <span class="text-danger">Checked out</span>
                                                @else
                                                    {{-- Room is pending --}}
                                                    <span class="text-warning">Pending</span>
                                                @endif
                                            </td>
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
                                <p>{{ $reservation->remarks }}</p>
                                @if ($reservation->remarks_by_guest)
                                    <p>Guest : {{ $reservation->remarks_by_guest }}</p>
                                @endif
                                @if ($reservation->remarks_by_admin)
                                    <p>Admin : {{ $reservation->remarks_by_admin }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                {{-- </div>
            </div> --}}
            {{-- <x-footer/>
        </div>
    </div> --}}

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

    $(document).on('click', '#reject', function () {
        const id = $('#reservationId').val();
        const reservationNo = $('#reservationNo').val();
        $.ajax({
            url: "{{ route('reject-reservation') }}",
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
                        title: "Reservation rejected",
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

        // Function to store selected room IDs in an array
        function storeSelectedRooms() {
            const selectedRooms = [];
            $('#room-table tbody tr').each(function() {
                if ($(this).hasClass('table-active')) {
                    const roomId = $(this).data('id');
                    if (roomId !== undefined) {
                        selectedRooms.push(roomId);
                    }
                    // selectedRooms.push(roomId);
                }
            });
            return selectedRooms;
        }

        // Function to create and submit the check-in form
        function submitCheckinForm(selectedRooms) {
            // Create a form element
            const form = $('<form>').attr({
                method: 'POST',
                action: '{{ route("room-check-in") }}', // Replace with your check-in route
            });

            const csrfToken = $('meta[name="csrf-token"]').attr('content');

            $('<input>').attr({
                type: 'hidden',
                name: '_token',
                value: csrfToken,
            }).appendTo(form);

            // Create hidden input fields for each selected room ID
            selectedRooms.forEach(function(roomId) {
                $('<input>').attr({
                    type: 'hidden',
                    name: 'room_ids[]', // Assuming your backend expects an array of room IDs
                    value: roomId,
                }).appendTo(form);
            });

            $('<input>').attr({
                type: 'hidden',
                name: 'reservation_id',
                value: $('#reservationId').val(),
            }).appendTo(form);

            // If there are no selected rooms, don't submit the form
            console.log(selectedRooms);
            if (selectedRooms.length > 0) {
                // Append the form to the document body and submit it
                form.appendTo('body').submit();
            } else {
                // Handle the case where no rooms are selected (e.g., display an error message)
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false, 
                    timer: 3000,
                    timerProgressBar: true,
                    title: "Room may be already checked in!",
                    icon: "error"
                });
                Toast.fire();
                console.log('No rooms selected for check-in.');
            }

            // // Append the form to the document body and submit it
            // form.appendTo('body').submit();
        }

        // Add event listener to the check-in button
        $('#checkin-button').click(function() {
            const selectedRooms = storeSelectedRooms();
            // Perform check-in action with selected room IDs
            console.log('Selected rooms for check-in:', selectedRooms);
            // Submit the form with selected room IDs
            submitCheckinForm(selectedRooms);
        });

        // Add event listener to each row for selection toggle
        $('#room-table tbody tr').click(function() {
            toggleRowSelection(this);
        });
    });



   

    </script>

{{-- <x-main-footer/> --}}
