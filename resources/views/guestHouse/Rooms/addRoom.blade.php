<!-- resources/views/profile.blade.php -->

{{-- {{ dd($roomCategories ); }} --}}

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-admin.navbar/>

            <div class="page-content">
                <x-page-header :prev="'Manage Rooms'" :title="'Add'"/>
                <div class="d-flex flex-column border card">
                    <div class="d-flex col nav nav-tabs bg-light pt-2 px-2">
                        <div>
                            <a href="{{ route('guest-house-admin-rooms') }}" class="text-capitalize nav-link">
                                view
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('guest-house-admin-add-room') }}" class="text-capitalize nav-link active px-4 fw-bold">
                                add
                            </a>
                        </div>
                    </div>
                    <div class="pt-3">
                        <form id="newRoomForm" class="mx-2 mx-md-3" action="{{ route('guest-house-new-room') }}" method="POST">
                            @csrf
                            <div class="row m-0 p-0">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="roomNumber" class="form-label">Room Number <x-required/> </label>
                                        <input id="roomNumber" class="form-control" name="roomNumber" type="text" placeholder="Room number">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="roomCategory" class="form-label">Room Category <x-required/> </label>
                                        <select class="form-control" readOnly name="roomCategory" id="roomCategory" required>
                                            <option value="" disabled selected>--select--</option>
                                            @foreach ( $roomCategories as $roomCategory )
                                                <option value="{{ $roomCategory->id }}" data-price="{{ $roomCategory->price_modifier }}">{{ $roomCategory->Category->name }}</option>
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
                                                <option value="{{ $bedCategory->id }}" data-price="{{ $bedCategory->price_modifier }}">{{ $bedCategory->Bed->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Price</label>
                                        <select name="price" id="price" class="form-control text-capitalize">
                                            <option value="" selected disabled>--select--</option>
                                            @foreach ($roomRates as $roomRate)
                                                <option value="{{ $roomRate->id }}">{{ $roomRate->price }} | {{ $roomRate->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div> --}}
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="numberOfBeds" class="form-label">Number Of Beds <x-required/> </label>
                                        {{-- <input id="numberOfBeds" class="d-none form-control" name="" type="text" 
                                        onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="Number of bed"> --}}
                                        <select name="numberOfBeds" id="numberOfBeds" class="form-control">
                                            <option value="" selected disabled>--select--</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="capacity" class="form-label">Capacity</label>
                                        <input id="capacity" class="form-control" name="capacity" type="text" placeholder="Capacity (optional)" 
                                        onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Base Price</label>
                                        <input id="price" type="text" class="form-control" name="basePrice" value="{{ $guestHouse->base_price }}" placeholder="Base price" readonly disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="width" class="form-label">Width</label>
                                        <input id="width" class="form-control" name="width" type="text" 
                                            onkeypress="return event.charCode >= 48 && event.charCode <= 57" 
                                            placeholder="Width (optional)">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="length" class="form-label">Length</label>
                                        <input id="width" class="form-control" name="length" type="text" 
                                            onkeypress="return event.charCode >= 48 && event.charCode <= 57" 
                                            placeholder="Length (optional)">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="roomDetails" class="form-label">Room Details</label>
                                        <textarea class="form-control" name="roomDetails" id="roomDetails" cols="30" rows="1"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Total Rate</label>
                                        <span class="d-block w-100 p-1 text-darkgray" id="total">0.00</span>
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
        calculatePrice();
    })

    $(document).on('change', '#bedCategory', function () {
        calculatePrice();
    });

    $(document).on('change', '#roomCategory', function () {
        calculatePrice();
    });

    const calculatePrice = () => {
        var total = 0;
        total = total + parseFloat($('#bedCategory').find(':selected').data('price')) + parseFloat($('#roomCategory').find(':selected').data('price')) + (parseFloat($('#price').val()) || 0);
        console.log(total);
        $('#total').html(total);
    }


    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $("#features").on('input', function () {
            console.log('first');
            $.ajax({
                url: '',
                type: 'GET',
                success: function(res) {
                    console.log(res);
                }
            })
        });

    
    });

    </script>

<x-main-footer/>