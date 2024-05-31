<!-- resources/views/guestHouse/Transaction/index.blade.php -->

{{-- {{ dd($reservation, $rooms, $guest); }} --}}

{{-- <x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-admin.navbar/>

            <div class="page-content">
                <x-page-header :prev="'Manage Transactions'" :title="'Check In Rooms'" />
                <div class="d-flex flex-column border card">
                    <div class="col nav nav-tabs bg-light pt-2 px-2">
                        <div>
                            <a href="{{ route('transaction') }}" class="text-capitalize nav-link">
                                view
                            </a>
                        </div>
                        <div>
                            <button class="text-capitalize nav-link active px-4 fw-bold">
                                Check in
                            </button>
                        </div>
                        <div>
                            <a href="{{ route('check-out-view') }}" class="text-capitalize nav-link">
                                Check out
                            </a>
                        </div>
                    </div> --}}
                    
                    <div class="row p-3">
                        <div class="col-md-11 mx-auto my-4">
                            <form action="{{ route('get-check-in') }}" method="post">
                                @csrf
                                <div class="input-group mb-5">
                                    <input type="text" class="form-control" name="reservation_no" 
                                    @if (isset($reservation_no))
                                        value="{{ $reservation_no }}"
                                    @endif 
                                    placeholder="Reservation No">
                                    <input type="hidden" id="reservationId"
                                    @if (isset($reservation_no))
                                        value="{{ $reservation->id }}"
                                    @endif 
                                    >
                                    <button class="btn btn-primary" type="submit">Search</button>
                                </div>
                            </form>
                            @if(isset($reservation))
                            <div class="row mb-3">
                                <div class="">
                                    <p class="fw-bold mb-1">Check In Date:  <span class="fw-medium text-darkgray">{{ $reservation->check_in_date }}</span></p>
                                    <p class="fw-bold mb-1">Check Out Date: <span class="fw-medium text-darkgray">{{ $reservation->check_out_date }}</span></p>
                                </div>
                            </div>
                            <div class="mb-3">
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
                                                {{-- Room is checked in --}}
                                                {{-- <span class="text-success">Checked in</span> --}}
                                                <tr class="text-secondary">
                                            @else
                                                {{-- Room is pending --}}
                                                {{-- <span class="text-warning">Pending</span> --}}
                                                <tr data-id="{{ $room->id }}" class="cursor">
                                            @endif
                                            
                                                <td>{{ $room->roomDetails->room_number }}</td>
                                                <td>{{ $room->roomDetails->roomCategory->Category->name }}</td>
                                                <td>{{ $room->roomDetails->total_price }}</td>
                                                <td>
                                                    @if (in_array($room->id, $checked_in_rooms))
                                                        {{-- Room is checked in --}}
                                                        <span class="text-success">Checked in</span>
                                                    @else
                                                        {{-- Room is pending --}}
                                                        <span class="text-warning">Pending</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach                                
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-end mb-3">
                                @php
                                    $today = \Carbon\Carbon::today();
                                    $checkInDate = \Carbon\Carbon::parse($reservation->check_in_date);
                                @endphp

                                @if ($checkInDate <= $today)
                                    <span></span>
                                @else
                                    <button class="btn btn-success" id="checkin-button">Check in</button>
                                @endif
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
                {{-- </div>
                <x-footer/>
            </div>
        </div>
    </div> --}}

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