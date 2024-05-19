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
                        <form action="{{ route('new-booking') }}" method="post" class="form" enctype="multipart/form-data">
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
                                        <small>{{ $guestHouse->district_name->name }}, {{ $guestHouse->state_name->name }}</small>
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
                                            </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            
                            {{-- <div class="mb-2 col-md-10 mx-auto">
                                <div class="row mb-2">
                                    <label for="" class="col-md-4 mb-2">Reservation for <x-required/> </label>
                                    <div class="col-md-8 mb-2 row">
                                        <div class="col">
                                            <input type="radio" name="reservation_for" id="self_reservation" value="Self">
                                            <label for="self_reservation">Self</label>
                                        </div>
                                        <div class="col">
                                            <input type="radio" name="reservation_for" id="other_reservation" value="Other">
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
                                            <option value="personal">Personal</option>
                                            <option value="official">Official</option>
                                        </select>
                                    </div>
                                    @error('visitingReason')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                    @enderror
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
                            </div> --}}
                            @if ( $guestHouse->guest_type === $guestDetails->guestcategory_id )
                                <div class="col-md-10 mx-auto mb-3">
                                    <p class="p-2 bg-warning bg-opacity-50 text-danger w-100 text-center">General publics are not allowed.</p>
                                </div> 
                            @else 
                                <div class="text-end mb-3 col-md-10 mx-auto mb-3">
                                    <button data-href="{{ route('book-form', ['id'=> $guestHouse->id,'checkin'=> $checkInDate,'checkout'=> $checkOutDate]) }}" type="button" class="open-popup btn btn-sm btn-primary" type="text" id="">book</button>           
                                </div> 
                            @endif
                           
                            {{-- <span>{{ $guestDetails->guest_id }}</span>
                            <span>{{ $guestDetails->guestcategory_id }}</span>
                            <span>{{ $guestDetails->guestCategory->name }}</span>
                            <span>{{ $guestHouse->guest_type }}</span>              --}}
                        </form>
                        <x-popup/>
                    </div>  
                </div>
                <x-footer/>
            </div>
        </div>
    </div>

    <!-- Custom js for this page -->
    <script>    


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
