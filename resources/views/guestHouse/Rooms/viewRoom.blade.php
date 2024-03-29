<!-- resources/views/guestHouse/GuestHouse/add.blade.php -->

{{-- {{ dd($bookedDates); }} --}}

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-admin.navbar/>

            <div class="page-content">
                <x-page-header :prev="'Manage Rooms'" :title="'view'"/>
                <div class="d-flex flex-column border card">
                    <div class="d-flex col nav nav-tabs bg-light pt-2 px-2">
                        <div>
                            <button id="roomButton" class="text-capitalize nav-link active px-4 fw-bold">
                                details
                            </button>
                        </div>
                        <div>
                            <button id="featureButton" class="text-capitalize nav-link">
                                features
                            </button>
                        </div> 
                    </div>
                    <div class="pt-3" id="roomView">
                        <form id="newRoomForm" class="mx-2 mx-md-5 d-flex flex-column flex-md-row-reverse" action="{{ route('guest-house-new-room') }}" method="POST">
                            @csrf
                            <div class="col-lg-4 col-md-6 ps-3">
                                <div class="auto-jsCalendar " id="bookingCalendar"></div>
                            </div>
                            <div class="col-lg-8 col-md-6">
                                <div class="mb-3">
                                    <label for="roomNumber" class="form-label">Room Number</label>
                                    <input id="roomNumber" class="form-control" name="roomNumber" type="text" value="{{ $room->room_number }}" placeholder="Room number">
                                </div>
                                <div class="mb-3">
                                    <label for="price" class="form-label">Price</label>
                                    <select name="price" id="price" class="form-control text-capitalize">
                                        <option value="" disabled>--select--</option>
                                        @foreach ($roomRates as $roomRate)
                                            <option value="{{ $roomRate->id }}"
                                                @if ( $roomRate->id === $room->room_rate )
                                                    selected
                                                @endif
                                                >
                                                {{ $roomRate->price }} | {{ $roomRate->name }} | {{ $roomRate['roomCategory']->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="numberOfBeds" class="form-label">Number Of Beds</label>
                                    <select name="numberOfBeds" id="numberOfBeds" class="form-control">
                                        <option value="" disabled>--select--</option>
                                        @for ($i = 1; $i<=5; $i++)
                                            <option value="{{ $i }}"
                                            @if ($room->number_of_beds === $i)
                                                selected
                                            @endif
                                            >{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="capacity" class="form-label">Capacity</label>
                                    <input id="capacity" class="form-control" name="capacity" type="text" placeholder="Capacity" 
                                    value="{{ $room->capacity }}" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                </div>
                                <div class="mb-3">
                                    <label for="width" class="form-label">Width</label>
                                    <input id="width" class="form-control" name="width" type="text" value="{{ $room->width }}"
                                        onkeypress="return event.charCode >= 48 && event.charCode <= 57" 
                                        placeholder="Width (optional)">
                                </div>
                                <div class="mb-3">
                                    <label for="length" class="form-label">Length</label>
                                    <input id="width" class="form-control" name="length" type="text" value="{{ $room->length }}"
                                        onkeypress="return event.charCode >= 48 && event.charCode <= 57" 
                                        placeholder="Length (optional)">
                                </div>
                                <div class="mb-3">
                                    <label for="roomCategory" class="form-label">Room Category</label>
                                    <select class="form-control" readOnly name="roomCategory" id="roomCategory" required>
                                        <option value="" disabled>--select--</option>
                                        @foreach ( $roomCategories as $roomCategory )
                                            <option value="{{ $roomCategory->id }}" 
                                            @if ( $roomCategory->id === $room['roomRate']->room_category )
                                                selected
                                            @endif    
                                            >{{ $roomCategory->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="roomDetails" class="form-label">Room Details</label>
                                    <textarea class="form-control" name="roomDetails" id="roomDetails" cols="30" rows="1"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="pt-3" id="featureView">
                        <div class="table-responsive px-3">
                            <div class="p-2 text-end">
                                <button class="btn btn-sm btn-info">Add feature</button>
                            </div>
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Remarks</th>
                                        <th>Action</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($features as $feature)
                                    {{-- {{ dd($guestHouse->country_name->name) }} --}}
                                        <tr>
                                            <td>{{ $feature->name }}</td>
                                            <td>{{ $feature->description }}</td>
                                            <td>{{ $feature->remarks }}</td>
                                            <td>
                                                <div class="d-flex py-0">
                                                    <a href="{{ route('edit-sub-user', ['id' => $feature->id]) }}" class="btn btn-sm btn-outline-primary">edit</a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch px-auto me-0">
                                                    <input type="checkbox" class="form-check-input" id="formSwitch1">
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-none mx-2 mx-md-3">
                            <div class="d-flex justify-content-between p-3">
                                <h5 class="text-secondary">Employees</h5>
                            </div>
                            <div class="d-flex justify-content-end py-3">
                                <a href="{{ route('add-sub-users') }}" class="btn btn-sm btn-outline-primary">
                                    Add employee
                                </a>
                                {{-- <button id="formSubmit" disabled type="submit" class="btn btn-success">Save changes</button> --}}
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
        $('.dropify-message p').css('font-size', '16px'); 
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });




        // $("#saasForm").removeClass('d-flex').addClass('d-none');
        $("#featureView").hide();
        $("#roomView").show();

        $("#roomButton").on('click', function() {
            // console.log('show');
            $("#featureButton").removeClass('active px-4 fw-bold');
            $("#roomButton").addClass('active px-4 fw-bold');
            $("#featureView").hide();
            $("#roomView").show();
        });

        $("#featureButton").on('click', function() {
            // console.log('hide');
            $("#featureButton").addClass('active px-4 fw-bold');
            $("#roomButton").removeClass('active px-4 fw-bold');
            $("#featureView").show();
            $("#roomView").hide();
        });
    
    });

    </script>

    {{-- @foreach ($bookedDates as $bookedDate)
        <span>{{ $bookedDate->date }}</span>
    @endforeach --}}

    <script>
    // $(document).ready( function () {
    //     var myCalendar = $('#bookingCalendar');
    //     myCalendar.select([
    //         "01/03/2024",
    //         "02/03/2024",
    //     ]);
    // })
    $(document).ready( function () {
        var bookedDates = {!! json_encode($bookedDates) !!};
        console.log(bookedDates)
        var myCalendar = $('#bookingCalendar');
        myCalendar.select(bookedDates);
    });
    </script>
<x-main-footer/>
