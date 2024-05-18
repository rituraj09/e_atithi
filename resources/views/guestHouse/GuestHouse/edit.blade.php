<!-- resources/views/guestHouse/GuestHouse/add.blade.php -->
{{-- 
<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-admin.navbar/>

            <div class="page-content">
                <x-page-header :prev="'Manage Guest Houses'" :title="'Edit'"/>
                <div class="d-flex flex-column border card"> --}}
                    {{-- <div class="d-flex col nav nav-tabs bg-light pt-2 px-2">
                        <div>
                            <a href="{{ route('all-guest-house') }}" class="text-capitalize nav-link">
                                view
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('add-guest-house') }}" class="text-capitalize nav-link">
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
                        <form class="mx-2 mx-md-3" id="newRoomForm" action="{{ route('update-guest-house') }}" method="POST">
                            @csrf
                            <div>
                                <input type="hidden" name="id" value="{{ $guestHouse->id }}">
                            </div>
                            <div class="row m-0 p-0">
                                <div class="mb-3 stretch-card">
                                    <div class="w-100">
                                        <input type="file" id="myDropify"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Guest House Name</label>
                                        <input id="name" class="form-control editable" name="name" type="text" 
                                        value="{{ $guestHouse->name }}" placeholder="Guest house name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="guestHouseType" class="form-label">Guest House Types</label>
                                        <select class="form-control editable" name="guestHouseType" id="guestHousetype">
                                            {{-- <option value="" disabled>--select--</option> --}}
                                            @foreach ( $guestHouseTypes as $guestHouseType )
                                                <option value="{{ $guestHouseType->id }}"
                                                    @if ($guestHouse->guest_house_type === $guestHouseType->id)
                                                        selected
                                                    @endif
                                                    >{{ $guestHouseType->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Official Email</label>
                                        <input id="email" class="form-control editable" name="email" type="text" 
                                        value="{{ $guestHouse->official_email }}" placeholder="Official email id">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone No.</label>
                                        <input id="phone" class="form-control editable" name="phone" type="text" value="{{ $guestHouse->contact_no }}" 
                                        onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="official contact no">
                                    </div>
                                </div>
                                {{-- address --}}
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <input id="address" class="form-control editable" name="address" type="text" 
                                        value="{{ $guestHouse->address }}" placeholder="optional">
                                    </div>
                                </div>
                                {{-- country --}}
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="country" class="form-label">Country</label>
                                        <select class="form-control editable" name="country" id="country">
                                            {{-- <option value="" disabled>--select--</option> --}}
                                            @foreach ( $countries as $country )
                                                <option 
                                                    value="{{ $country->id }}"
                                                    @if ($guestHouse->country === $country->id)
                                                        selected
                                                    @endif
                                                >{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- state --}}
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="state" class="form-label">State</label>
                                        <select class="form-control editable" name="state" id="state">
                                            {{-- <option value="" disabled>--select--</option> --}}
                                            @foreach ( $states as $state )
                                                <option 
                                                    value="{{ $state->id }}"
                                                    @if ($guestHouse->state === $state->id)
                                                        selected
                                                    @endif
                                                >{{ $state->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- district --}}
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="district" class="form-label">District</label>
                                        <select class="form-control editable" name="district" id="district">
                                            {{-- <option value="" disabled>--select--</option> --}}
                                            @foreach ( $districts as $district )
                                                <option 
                                                    value="{{ $district->id }}"
                                                    @if ($guestHouse->district === $district->id)
                                                        selected
                                                    @endif
                                                >{{ $district->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="pin" class="form-label">PIN</label>
                                        <input id="pin" class="form-control editable" name="pin" type="text" value="{{ $guestHouse->pin }}" 
                                        onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="Pin no">
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end py-3">
                                <button id="formSubmit" disabled type="submit" class="btn btn-success">Save changes</button>
                            </div>
                        </form>
                    </div>
                {{-- </div>
            </div>
            <x-footer/>
        </div>
    </div> --}}


    <script>
    $(document).ready(function() {
        $('.dropify-message p').css('font-size', '16px'); 
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // // country
        // $("#country").on('change', function () {
        //     const c_id = $("#country").val();
        //     console.log(c_id);

        //     const stateurl = "{{ route('get-states', ['cid' => ':cid']) }}".replace(':cid', c_id);
        //     $.ajax({
        //         url: stateurl,
        //         type: 'GET',
        //         success: function (res) {
        //             let html = '<option value="" selected disabled>--select--</option>'; // Default option
        //             html += res.map(state => `<option value="${state.id}" >${state.name}</option>`).join('');
        //             $("#state").html(html);
        //         }
        //     })
        // });

        // // district
        // $("#state").on('change', function () {
        //     const s_id = $("#state").val();
        //     console.log(s_id);

        //     const districturl = "{{ route('get-districts', ['sid' => ':sid']) }}".replace(':sid', s_id);
        //     $.ajax({
        //         url: districturl,
        //         type: 'GET',
        //         success: function (res) {
        //             let html = '<option value="" selected disabled>--select--</option>'; // Default option
        //             html += res.map(state => `<option value="${state.id}" >${state.name}</option>`).join('');
        //             $("#district").html(html);
        //         }
        //     })
        // });


        $(".editable").on('changeinput change', function() {
            $("#formSubmit").attr('disabled', false);
        });





        // $("#saasForm").removeClass('d-flex').addClass('d-none');
        $("#viewSaasForm").hide();
        $("#hideSaasForm").show();

        $("#viewSaasForm").on('click', function() {
            // console.log('show');
            $("#saasForm").removeClass('d-none').addClass('d-flex');
            $("#viewSaasForm").hide();
            $("#hideSaasForm").show();
        });

        $("#hideSaasForm").on('click', function() {
            // console.log('hide');
            $("#saasForm").removeClass('d-flex').addClass('d-none');
            $("#viewSaasForm").show();
            $("#hideSaasForm").hide();
        });
    
    });

    </script>

{{-- <x-main-footer/> --}}