<!-- resources/views/profile.blade.php -->

{{-- {{ dd($roomCategories ); }} --}}

{{-- <x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-admin.navbar/>

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
                    </div> --}}
                    <div class="pt-3">
                        <form id="newRoomForm" class="mx-2 mx-md-3" action="{{ route('guest-house-new-room') }}" method="POST">
                            @csrf
                            <div class="row m-0 p-0">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="roomNumber" class="form-label">Room Number <x-required/> </label>
                                        <input id="roomNumber" class="form-control" name="roomNumber" value="{{ $room->room_number }}" readonly disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="roomCategory" class="form-label">Room Category <x-required/> </label>
                                        <select class="form-control" readOnly name="roomCategory" id="roomCategory" required>
                                            @foreach ( $roomCategories as $roomCategory )
                                                <option value="{{ $roomCategory->id }}" data-price="{{ $roomCategory->price_modifier }}"
                                                @if ( $roomCategory->id === $room->roomCategory->id )
                                                    selected
                                                @endif    
                                                >{{ $roomCategory->Category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="roomCategory" class="form-label">Bed Category <x-required/> </label>
                                        <select class="form-control" readOnly name="bedCategory" id="bedCategory" required>
                                            <option value="" disabled selected>--select--</option>
                                            @foreach ( $bedCategories as $bedCategory )
                                                <option value="{{ $bedCategory->id }}" data-price="{{ $bedCategory->price_modifier }}"
                                                @if ( $bedCategory->id === $room->bedType[0]->id )
                                                    selected
                                                @endif     
                                                >{{ $bedCategory->Bed->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="numberOfBeds" class="form-label">Number Of Beds <x-required/> </label>
                                        <select name="numberOfBeds" id="numberOfBeds" class="form-control" disabled>
                                            <option value="1" selected disabled>1</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="capacity" class="form-label">Capacity</label>
                                        <select name="capacity" id="capacity" class="form-control">
                                            <option value="" selected disabled>--select--</option>
                                            @for ( $i = 1; $i <= $room->bedType[0]->capacity; $i++ )
                                                <option value="{{ $i }}"
                                                @if ( $room->capacity === $i )
                                                    selected
                                                @endif
                                                >{{ $i }}</option>
                                            @endfor
                                        </select>
                                        {{-- <input id="capacity" class="form-control" name="capacity" type="text" placeholder="Capacity (optional)" 
                                        onkeypress="return event.charCode >= 48 && event.charCode <= 57"> --}}
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="width" class="form-label">Width</label>
                                        <input id="width" class="form-control" name="width" type="text" 
                                            onkeypress="return event.charCode >= 48 && event.charCode <= 57" 
                                            placeholder="Width (optional)" value="{{ $room->width }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="length" class="form-label">Length</label>
                                        <input id="width" class="form-control" name="length" type="text" 
                                            onkeypress="return event.charCode >= 48 && event.charCode <= 57" 
                                            placeholder="Length (optional)" value="{{ $room->length }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="roomDetails" class="form-label">Room Details</label>
                                        <textarea class="form-control" name="roomDetails" id="roomDetails" cols="30" rows="1"></textarea>
                                    </div>
                                </div>
                                <hr>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Base Price</label>
                                        <input id="price" type="text" class="form-control" name="basePrice" value="{{ $guestHouse->base_price }}" placeholder="Base price" readonly disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Govt Base Price</label>
                                        <input id="govtPrice" type="text" class="price form-control" name="basePrice" value="{{ $guestHouse->govt_base_price }}" placeholder="Base price" readonly disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Total Rate</label>
                                        <span class="d-block w-100 p-1 text-darkgray" id="total">{{ $room->total_price }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Total Govt Rate</label>
                                        <span class="d-block w-100 p-1 text-darkgray" id="totalGovt">{{ $room->total_govt_price }}</span>
                                    </div>
                                </div>
                            </div>
                
                            <div class="d-flex justify-content-end py-3 px-3">
                                <button id="formSubmit" class="btn btn-success mx-auto">Submit</button>
                            </div>
                        </form>
                    </div>
                {{-- </div>
            </div>
        </div>
    </div> --}}

    <script>
    $(document).on('change', '#bedCategory', function () {
        calculatePrice();
    });

    $(document).on('change', '#roomCategory', function () {
        calculatePrice();
    });

    const calculatePrice = () => {
        var total = 0;
        var totalGovt = 0;
        total = total + parseFloat($('#bedCategory').find(':selected').data('price')) + parseFloat($('#roomCategory').find(':selected').data('price')) + (parseFloat($('#price').val()) || 0);
        totalGovt = totalGovt + parseFloat($('#bedCategory').find(':selected').data('price')) + parseFloat($('#roomCategory').find(':selected').data('price')) + (parseFloat($('#govtPrice').val()) || 0);
        console.log(total);
        $('#total').html(total);
        $('#totalGovt').html(totalGovt);
    }
    </script>


{{-- <x-main-footer/> --}}