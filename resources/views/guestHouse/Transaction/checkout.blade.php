<!-- resources/views/guestHouse/Transaction/index.blade.php -->

{{-- {{ dd($rooms); }} --}}

{{-- <x-header/>
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
                    </div> --}}
                    <div class="row p-3">
                        <div class="col-md-11 mx-auto my-4">
                            <form action="{{ route('get-check-out') }}" method="POST">
                                @csrf
                                <input type="hidden" id="guest_id" value="{{ $checked_in_rooms[0]->reservationDetails->guest_id }}">
                                <input type="hidden" id="transaction_id" value="{{ $checked_in_rooms[0]->transaction_id }}">
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
                            @if (isset($reservation))
                                <div class="row mb-3">
                                    <div class="">
                                        <p class="fw-bold mb-1">Transaction ID: <span class="fw-medium text-darkgray">{{ $checked_in_rooms[0]->transaction_id }}</span></p>
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
                                            <th class="text-darkgray">Check in date</th>
                                            <th class="text-darkgray">Rate</th>
                                            <th class="text-darkgray">total Cost</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($checked_in_rooms as $room)
                                                @if (in_array($room->reservedRooms->id, $checked_out_rooms))
                                                    <tr class="text-secondary">
                                                @else
                                                    <tr data-id="{{ $room->id }}" class="cursor">
                                                @endif
                                                    <td>{{ $room->reservedRooms->roomDetails->room_number }}</td>
                                                    <td>
                                                        {{ $room->reservedRooms->roomDetails->roomCategory->Category->name }}, 
                                                        {{ $room->reservedRooms->roomDetails->bedType[0]->name }}
                                                    </td>
                                                    <td>{{ $room->checked_in_date }}</td>
                                                    <td>{{ $room->reservedRooms->roomDetails->total_price }}</td>
                                                    <td class="eachTotal">{{ $room->totalCost }}.00</td>
                                                </tr>
                                                {{-- @endif --}}
                                            @endforeach                                
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="5" class="text-end" id="total-amount"></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <input type="hidden" id="total" readonly disabled>
                                </div>
                                <div class="d-flex justify-content-end mb-3">
                                    @php
                                        $today = \Carbon\Carbon::today();
                                        $checkInDate = \Carbon\Carbon::parse($reservation->check_in_date);
                                    @endphp

                                    @if (!$checkInDate->isFuture())
                                        <button class="btn btn-success" id="checkout-button">Check Out</button>
                                    @else
                                        <span></span>
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
        var total = 0;
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
        function submitCheckoutForm(selectedRooms) {
            // Create a form element
            const form = $('<form>').attr({
                method: 'POST',
                action: '{{ route("room-check-out") }}', // Replace with your check-in route
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

            $('<input>').attr({
                type: 'hidden',
                name: 'guest_id',
                value: $('#guest_id').val(),
            }).appendTo(form);

            $('<input>').attr({
                type: 'hidden',
                name: 'transaction_id',
                value: $('#transaction_id').val(),
            }).appendTo(form);

            $('<input>').attr({
                type: 'hidden',
                name: 'amount',
                value: $('#total').val(),
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
        $('#checkout-button').click(function() {
            const selectedRooms = storeSelectedRooms();
            // Perform check-in action with selected room IDs
            console.log('Selected rooms for check-out:', selectedRooms);
            // Submit the form with selected room IDs
            submitCheckoutForm(selectedRooms);
        });

        // Add event listener to each row for selection toggle
        $('#room-table tbody tr').click(function() {
            toggleRowSelection(this);
            var valueText = $(this).find('.eachTotal').text().trim();
            console.log('Value text:', valueText);
            var value = parseFloat(valueText.replace(/,/g, '')); // Remove commas and parse as float
            if (!isNaN(value)) {
                total += value;
                $('#total-amount').text(total.toFixed(2));
                $('#total').val(total.toFixed(2)); // Display total with 2 decimal places
            } else {
                console.error('Invalid value:', valueText);
            }
        });
    });


    </script>

{{-- <x-main-footer/> --}}