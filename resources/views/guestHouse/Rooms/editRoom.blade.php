<!-- resources/views/profile.blade.php -->

{{-- {{ dd($roomCategories ); }} --}}

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-navbar/>

            <div class="page-content">
                <x-page-header :prev="'Manage Rooms'" :title="'Edit'"/>
                <div class="d-flex flex-column border card">
                    <div class="d-flex col nav nav-tabs bg-light pt-2 px-2">
                        <div>
                            <a href="{{ route('guest-house-admin-rooms') }}" class="text-capitalize nav-link">
                                view
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('guest-house-admin-add-room') }}" class="text-capitalize nav-link">
                                add
                            </a>
                        </div>
                        <div>
                            <button class="text-capitalize nav-link active px-4 fw-bold">
                                edit
                            </button>
                        </div>
                    </div>
                    <div class="pt-3">
                        <form id="newRoomForm" class="mx-2 mx-md-3" action="{{ route('update-room') }}" method="POST">
                            @csrf
                            <div>
                                <input type="hidden" name="id" value="{{ $room->id }}">
                            </div>
                            <div class="row m-0 p-0">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="roomNumber" class="form-label">Room Number</label>
                                        <input id="roomNumber" class="form-control" name="roomNumber" type="text" value="{{ $room->room_number }}" placeholder="Room number">
                                    </div>
                                </div>
                                <div class="col-md-6">
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
                                </div>
                                <div class="col-md-6">
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
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="capacity" class="form-label">Capacity</label>
                                        <input id="capacity" class="form-control" name="capacity" type="text" placeholder="Capacity" 
                                        value="{{ $room->capacity }}" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="width" class="form-label">Width</label>
                                        <input id="width" class="form-control" name="width" type="text" value="{{ $room->width }}"
                                            onkeypress="return event.charCode >= 48 && event.charCode <= 57" 
                                            placeholder="Width (optional)">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="length" class="form-label">Length</label>
                                        <input id="width" class="form-control" name="length" type="text" value="{{ $room->length }}"
                                            onkeypress="return event.charCode >= 48 && event.charCode <= 57" 
                                            placeholder="Length (optional)">
                                    </div>
                                </div>
                                <div class="col-md-6">
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
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="roomDetails" class="form-label">Room Details</label>
                                        <textarea class="form-control" name="roomDetails" id="roomDetails" cols="30" rows="1"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end py-3 px-3">
                                <button id="formSubmit" class="btn btn-success mx-auto">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
    
    var i = 0;


    $(document).on('change', '#price', function () {
        const rateId = $(this).val();
        console.log(rateId);
        const rateRoute = "{{ route('get-category-of-price') }}";

        $.ajax({
            url: rateRoute,
            type: 'POST',
            data: {rateId:rateId},
            success: function(res) {
                // console.log(res);
                const option = `<option value="${res['id']}" selected>${res['name']}</option>`;
                $("#roomCategory").html(option);
            }
        })
    })

    </script>

<x-main-footer/>