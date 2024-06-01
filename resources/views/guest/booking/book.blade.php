<form action="{{ route('new-booking') }}" method="post" class="form" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="guestHouse" value="{{ $guestHouse->id }}">
    <div class="row col-md-10 mx-auto my-3">
        <div class="col-md px-0">
            <h3>{{ $guestHouse->name }}</h3>
            <small>{{ $guestHouse->district_name->name }}, {{ $guestHouse->state_name->name }}</small>
        </div>
        <div class="col-md text-md-end px-0 text-dark">
            <p><small>From</small> {{ $checkInDate }}</p>
            <input type="hidden" name="checkIn" value="{{ $checkInDate }}">
            <p><small>to</small> {{ $checkOutDate }}</p>
            <input type="hidden" name="checkOut" value="{{ $checkOutDate }}">
        </div>
    </div>
    <div class="responsive-table mb-4 col-md-10 mx-auto">
        <h5 class="mb-1 text-darkgray">Available Rooms</h5>
        <table class="table text-center border border-primary">
            <thead class="table-primary">
                <tr>
                    <th>Room Number</th>
                    <th>Room Type</th>
                    <th>Capacity</th>
                    <th>Rate</th>
                    <th>Govt Rate</th>
                    <th class="text-center">Select</th>
                </tr>
            </thead>
            <tbody>
                @if ($rooms)
                    @foreach ( $rooms as $room )
                    <tr>
                        <td>{{ $room->room_number }}</td>
                        <td>
                            <div class="text-capitalize">
                                {{ $room->roomCategory->category->name }},
                                {{ $room->bedType[0]->name }}
                            </div>
                        </td>
                        <td>{{ $room->capacity }}</td>
                        <td class="price text-end pe-3">{{ $room->total_price }}</td>
                        <td class="price-govt text-end pe-3">{{ $room->total_govt_price }}</td>
                        <td>
                            <div class="form-check form-switch me-0 px-auto">
                                <input class="form-check-input m-auto" role="switch" type="checkbox" name="roomSelect" id="roomSelect" data-id="{{ $room->id }}">
                            </div>
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        <div class="alert alert-danger mt-1 mb-1 d-none" id="empty-rooms">Please select your rooms for staying.</div>
        @error('rooms')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
        @enderror
        <div class="mt-3">
            <span class="fs-5 fw-bold text-darkgray">Total</span>
            <div class="d-flex align-items-center justify-content-between mt-2">
                <span>Total per night :</span>
                <span><span id="total-per-night">0</span></span>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <span>Total :</span>
                <span><span id="total">0</span></span>
            </div>
        </div>
    </div>

    <div class="mb-2 col-md-10 mx-auto">
        <div class="row mb-2">
            <label for="" class="col-md-4 mb-2">Reservation for <x-required/> </label>
            <div class="col-md-8 mb-2 row">
                <div class="col">
                    <input type="radio" name="reservation_for" id="self_reservation" value="self">
                    <label for="self_reservation">Self</label>
                </div>
                <div class="col">
                    <input type="radio" name="reservation_for" id="other_reservation" value="other">
                    <label for="other_reservation">Other</label>
                </div>
            </div>
            @error('reservation_for')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        
        <div id="optional">

        </div>
        <div class="row">
            <label for="" class="col-md-4 mb-2">Reason for visiting <x-required/> </label>
            <div class="col-md-8 mb-2">
                <select name="visitingReason" id="visitingReason" class="form-control">
                    <option value="" selected disabled>--select--</option>
                    @foreach ($reservationReasons as $reservationReason)
                        <option value="{{ $reservationReason->id }}">{{ $reservationReason->reason_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <label for="" class="col-md-4 mb-2">ID Proof <x-required/> </label>
            <div class="col-md-8 mb-2">
                <input name="idFile" id="idFile" type="file" class="form-control">
            </div>
            @error('idFile')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="row hidden">
            <label for="" class="col-md-4 mb-2">Occupency</label>
            <div class="col-md-8 mb-2">
                <input type="text" class="form-control" placeholder="Occupency (optional)">
            </div>
        </div>

        <div class="row">
            <label for="" class="col-md-4 mb-2">Remarks</label>
            <div class="col-md-8 mb-2">
                <textarea name="" id="" cols="30" rows="3" class="form-control"></textarea>
            </div>
        </div>
    </div>
    @if ( $guestHouse->guest_type === $guestDetails->guestcategory_id )
        <div class="col-md-10 mx-auto mb-3">
            <p class="p-2 bg-warning bg-opacity-50 text-danger w-100 text-center">General publics are not allowed.</p>
        </div> 
    @else 
        @if ( $guestHouse->payment_type === 1 )  {{-- 1 for post paid --}}
        <div class="text-end mb-3 col-md-10 mx-auto mb-3">
            <span class="me-4 text-secondary">Payment mode: post paid</span>
            <button type="button" class="open-popup btn btn-sm btn-primary" type="text" id="book">book</button>           
        </div>  
        @else 
        <div class="text-end mb-3 col-md-10 mx-auto mb-3">
            <span class="me-4 text-secondary">Payment mode : prepaid</span>
            <button type="button" class="open-popup btn btn-sm btn-success" type="text" data-href="{{ route('payment-view') }}">book</button>           
        </div>
        @endif
    @endif
</form>

<!-- Custom js for this page -->
<script>
    var guest;
    $(document).ready(function () {
        $("#self_reservation").on('click', function () {
            $("#optional").html('');
            guest = "{{ $guestDetails->guestcategory_id }}";
            console.log(guest)
        });

        $("#other_reservation").on('click', function () {
            guest = null;
            $("#optional").html(`
            <div class="row">
                <label for="" class="col-md-4 mb-2">Guest Name <x-required/> </label>
                <div class="col-md-8 mb-2">
                    <input type="text" class="form-control" name="guest_name" id="guest_name">
                </div>
            </div>
            <div class="row">
                <label for="" class="col-md-4 mb-2">Guest Category <x-required/> </label>
                <div class="col-md-8 mb-2">
                    <select name="guest_category" id="guest_category" class="form-control text-capitalize">
                        <option value="" selected disabled>--select--</option>
                        @foreach ($guestCategories as $guestCategory)
                            <option value="{{ $guestCategory->id }}">{{ $guestCategory->name }}</option>
                        @endforeach
                    </select>
                    @error('guest_category')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            `);
        });
    });

    $(document).ready(function () {
        var guestHouse = "{{ $guestHouse->id }}";
        var rooms = [];

        var startDate = new Date('{{ $checkInDate }}');
        var endDate = new Date('{{ $checkOutDate }}');

        // Calculate the difference in milliseconds
        var difference = endDate.getTime() - startDate.getTime();

        // Convert the difference from milliseconds to days
        var days = Math.ceil(difference / (1000 * 60 * 60 * 24));
        
        // console.log(days);
        $('#days').html(days);

        $('input[name="roomSelect"]').each(function() {
            $(this).prop('checked', false);
        });

        $('#guest_category').on('change', function () {
            $('input[name="roomSelect"]').each(function() {
                $(this).prop('checked', false);
            })
            console.log('change')
        });


        $('#book').on('click', function() {
            console.log(rooms, visitingReason, roomCategory);
            var checkin = "{{ $checkInDate }}";
            var checkout = "{{ $checkOutDate }}";
            var visitingReason = $('#visitingReason').val();
            var roomCategory = $('#roomCategory').val();
            var doc = $('#idFile').val();
            var total = $('#total').text();
            var reservation_for = $('input[name="reservation_for"]:checked').val();
            var guest_name = $("#guest_name");
            var guest_category = $("#guest_category");

            console.log(doc === null)

            console.log(visitingReason)

            if (reservation_for === 'other' && guest_name.val() === '') {
                guest_name.after(`<div class="alert alert-danger mt-1 mb-1">Please enter the guest name.</div>`);
            }
            if (reservation_for === 'other' && guest_category.val() === '') {
                guest_name.after(`<div class="alert alert-danger mt-1 mb-1">Please select a guest category.</div>`);
            }

            if (rooms.length === 0) {
                $('#empty-rooms').removeClass('d-none');
            } else if (visitingReason === null) {
                $("#visitingReason").after(`<div class="alert alert-danger mt-1 mb-1">Please select a visiting reason.</div>`);
            } else if (doc === null) {
                $("#idFile").after(`<div class="alert alert-danger mt-1 mb-1">Please select a visiting reason.</div>`);
            } else {

                var message = `You have to pay total ${total}/- Rupees`;

                $('<input>').attr({
                    type: 'hidden',
                    name: 'rooms', // Name of the input field
                    value: JSON.stringify(rooms) // Convert the array to a JSON string
                }).appendTo('.form');

                $('<input>').attr({
                    type: 'hidden',
                    name: 'totalCharge', // Name of the input field
                    value: $('#total').html(), // Convert the array to a JSON string
                }).appendTo('.form');

                Swal.fire({
                    title: "eAtithi",
                    text: message,
                    confirmButtonText: "Book",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('.form').submit();
                    }
                });
            }

        });

        $('input[name="roomSelect"]').on('change', function() {
            if ($(this).prop('checked')) {
                $(this).closest('tr').addClass('bg-selected');
                rooms.push($(this).data('id'));
                $('#empty-rooms').addClass('d-none');
            } else {
                $(this).closest('tr').removeClass('bg-selected');
                var roomId = $(this).data('id');
                var index = rooms.indexOf(roomId);
                if (index !== -1) {
                    rooms.splice(index, 1); // Remove the room ID from the array
                }
            }
            var total = 0;
            $('input[name="roomSelect"]:checked').each(function() {
                if (guest === null) {
                    if ($('#guest_category').val() === '1') {
                        var price = parseFloat($(this).closest('tr').find('.price').text());
                        console.log('gen1')
                    } else {
                        var price = parseFloat($(this).closest('tr').find('.price-govt').text());
                        console.log('govt1')
                    }
                } else {
                    if (guest === '1') {
                        var price = parseFloat($(this).closest('tr').find('.price').text());
                        console.log('gen2')
                    } else {
                        var price = parseFloat($(this).closest('tr').find('.price-govt').text());
                        console.log('govt2')
                    }
                }
                console.log(guest);
                console.log($('#guest_category').val())
                total += price;
            });
            $('#total-per-night').html(total.toFixed(2)); // Assuming you want to display the total with 2 decimal places
            $('#total').html((days * total).toFixed(2));
            console.log(rooms);
        });

    });

</script>