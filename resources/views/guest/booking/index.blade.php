<!-- resources/views/guestHouse/GuestHouse/view.blade.php -->

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-guest.guest-navbar/>

            <div class="page-content" style="background-color: #f1fcff">
                <div>
                    <x-page-header :title="'Guest House'" />
                    <div class="card row mb-2 p-3">
                        <form action="{{ route('new-booking') }}" method="post" class="form">
                            @csrf
                            <input type="hidden" name="guestHouse" value="{{ $guestHouse->id }}">
                            <div class="d-flex col-md-10 mx-auto my-2 flex-wrap">
                                
                                <div class="image-wrapper">
                                    <div>
                                        <img class="image-filler" src="https://www.contemporist.com/wp-content/uploads/2017/02/minimalist-modern-house-exteriors-030217-424-06a-800x856.jpg" style="grid-area: A;" alt="">
                                    </div>
                                    <div>
                                        <img class="image-filler" src="https://www.contemporist.com/wp-content/uploads/2017/02/minimalist-modern-house-exteriors-030217-424-06a-800x856.jpg" style="grid-area: B;" alt="">
                                    </div>
                                    <div>
                                        <img class="image-filler" src="https://www.contemporist.com/wp-content/uploads/2017/02/minimalist-modern-house-exteriors-030217-424-06a-800x856.jpg" style="grid-area: C;" alt="">
                                    </div>
                                    <div>
                                        <img class="image-filler" src="https://www.contemporist.com/wp-content/uploads/2017/02/minimalist-modern-house-exteriors-030217-424-06a-800x856.jpg" style="grid-area: D;" alt="">
                                    </div>
                                </div>
                                <div class="row mx-0 my-3 w-100">
                                    <div class="col-md px-0">
                                        <h3>{{ $guestHouse->name }}</h3>
                                        <small>Golaghat, Assam</small>
                                    </div>
                                    <div class="col-md text-md-end px-0 text-dark">
                                        <p><small>From</small> {{ $checkInDate }}</p>
                                        <input type="hidden" name="checkIn" value="{{ $checkInDate }}">
                                        <p><small>to</small> {{ $checkOutDate }}</p>
                                        <input type="hidden" name="checkOut" value="{{ $checkOutDate }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-10 mx-auto mb-3">
                                <h5 class="text-darkgray mb-1">
                                    Features
                                </h5>
                                <ul>
                                    <li>attached bathroom</li>
                                    <li>wifi</li>
                                </ul>
                            </div>
                        
                            <div class="responsive-table mb-4 col-md-10 mx-auto">
                                <h5 class="mb-1 text-darkgray">Available Rooms</h5>
                                <table class="table text-center border border-primary">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>Room Number</th>
                                            <th>Room Type</th>
                                            <th>Capacity</th>
                                            <th>Price per night</th>
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
                                                        {{ $room->roomCategory->name }},
                                                        {{ $room->bedType[0]->name }}
                                                    </div>
                                                </td>
                                                <td>{{ $room->capacity }}</td>
                                                <td class="price text-end pe-3">{{ $room->total_price }}</td>
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
                                <div class="row">
                                    <label for="" class="col-md-4 mb-2">Reason for visiting</label>
                                    <div class="col-md-8 mb-2">
                                        <select name="visitingReason" id="visitingReason" class="form-control">
                                            <option value="" selected disabled>--select--</option>
                                            <option value="personal">Personal</option>
                                            <option value="official">Official</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="" class="col-md-4 mb-2">ID Proof</label>
                                    <div class="col-md-8 mb-2">
                                        <input name="idFIle" id="idFile" type="file" class="form-control">
                                    </div>
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
                                    <button type="button" class="btn btn-sm btn-primary" type="text" id="book">book</button>           
                                </div>  
                                @else 
                                <div class="text-end mb-3 col-md-10 mx-auto mb-3">
                                    <span class="me-4 text-secondary">Payment mode : prepaid</span>
                                    <button type="button" class="open-popup btn btn-sm btn-success" type="text" data-href="{{ route('payment-view') }}">book</button>           
                                </div>
                                @endif
                            @endif
                            {{-- <span>{{ $guestDetails->guest_id }}</span>
                            <span>{{ $guestDetails->guestcategory_id }}</span>
                            <span>{{ $guestDetails->guestCategory->name }}</span>
                            <span>{{ $guestHouse->guest_type }}</span>              --}}
                        </form>
                        <x-popup/>
                    </div>  
                </div>
            </div>
        </div>
    </div>

    <!-- Custom js for this page -->
    <script>
    $(document).ready(function () {
        var guestHouse = "{{ $guestHouse->id }}";
        var rooms = [];

        // $("#startDate, #endDate").datepicker();

        // $('#calculate').click(function() {
            var startDate = new Date('{{ $checkInDate }}');
            var endDate = new Date('{{ $checkOutDate }}');

            // Calculate the difference in milliseconds
            var difference = endDate.getTime() - startDate.getTime();

            // Convert the difference from milliseconds to days
            var days = Math.ceil(difference / (1000 * 60 * 60 * 24));

            // console.log(days);
            $('#days').html(days);

            // $('#result').text(days + ' days');
        // });




        $('input[name="roomSelect"]').each(function() {
            $(this).prop('checked', false);
        });


        $('#book').on('click', function() {
            console.log(rooms, visitingReason, roomCategory);
            var checkin = "{{ $checkInDate }}";
            var checkout = "{{ $checkOutDate }}";
            var visitingReason = $('#visitingReason').val();
            var roomCategory = $('#roomCategory').val();
            var doc = $('#idFile').val();
            var total = $('#total').text();

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
                    // $.ajax({
                    //     url: "{{ route('new-booking') }}",
                    //     type: "POST",
                    //     data: {
                    //         rooms:rooms,
                    //         visitingReason:visitingReason,
                    //         roomCategory:roomCategory,
                    //         checkin:checkin,
                    //         checkout:checkout,
                    //         guestHouse:guestHouse,
                    //         doc:doc,
                    //     },
                    //     success: function(res){
                    //         console.log(res);
                            
                    //     },
                    // });
                }
            });

        });

        $('input[name="roomSelect"]').on('change', function() {
            if ($(this).prop('checked')) {
                $(this).closest('tr').addClass('bg-selected');
                rooms.push($(this).data('id'));
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
                var price = parseFloat($(this).closest('tr').find('.price').text());
                total += price;
            });
            $('#total-per-night').html(total.toFixed(2)); // Assuming you want to display the total with 2 decimal places
            $('#total').html((days * total).toFixed(2));
            console.log(rooms);
        });

    });


    $(document).ready(function () {
        var today = new Date();

        // var today = DateFormmate('yyyy-mm-dd');
        $('#from').prop('min', function () {
            return today.toISOString().split('T')[0];
        })
        $('#to').prop('min', function () {
            return today.toISOString().split('T')[0];
        })

        var f;
        $('#from').on('change', function () {
            f = $(this).val();
            $('#to').prop('min', function () {
                return f;
            })
        })

        var t;
        $('#to').on('change', function () {
            t = $(this).val();
            $('#from').prop('max', function () {
                return t;
            })
        })
    })

    </script>

<x-main-footer/>
