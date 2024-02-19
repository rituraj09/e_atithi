<!-- resources/views/guestHouse/GuestHouse/add.blade.php -->

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">

            @if(session('message'))
                <script>
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                    });
                    
                    Toast.fire({
                        icon: 'success',
                        title: 'Signed in successfully'
                    })
                </script>
            @endif
            <nav class="sidebar">
                <div class="sidebar-header">
                  <a href="#" class="sidebar-brand">
                    <span>e</span>Atithi <span>admin</span>
                  </a>
                  <div class="sidebar-toggler not-active">
                    <span></span>
                    <span></span>
                    <span></span>
                  </div>
                </div>
                <x-sidebar/>
              </nav>
            <x-navbar/>

            <div class="page-content">
                <div class="row">
					<div class="col-md-10 m-auto grid-margin stretch-card">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title mb-4">Guest House Details</h4>
								<form id="newRoomForm" action="{{ route('add-new-guest-house') }}" method="POST">
                                    @csrf
                                    <div class="row m-0 p-0">
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
                                    <div class="d-flex justify-content-between p-3">
                                        <h5 class="text-secondary">Employees</h5>
                                        {{-- <button> --}}
                                        <i id="viewSaasForm" style="cursor: pointer;" data-feather="chevron-down"></i>
                                        <i id="hideSaasForm" style="cursor: pointer;" data-feather="chevron-up"></i>
                                    </div>
                                    <div class="d-flex row px-4 py-2 bg-light bg-opacity-25 rounded" id="saasForm">
                                        @foreach ($employees as $employee)
                                        <div class="row m-0 mb-3 border-top pt-2 mt-2">
                                            <div class="col-md col-0 mt-2">
                                                <small><i class="link-icon" data-feather="user"></i></small>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="admin_name" class="form-label">Employee Name</label>
                                                    <input type="text" class="form-control" name="admin_name" value="{{ $employee->admin_name }}" placeholder="Admin name">
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="mb-3">
                                                    <label for="admin_role" class="form-label">Role</label>
                                                    <select 
                                                        name="admin_role" 
                                                        id="admin_role" 
                                                        class="form-control"
                                                        @foreach ($roles as $role)
                                                            @if ($employee->role === 2 || $role->name === 'admin')
                                                                disabled
                                                            @endif
                                                        @endforeach
                                                        >
                                                        @foreach ($roles as $role)
                                                            <option value="{{ $role->id }}" 
                                                                @if ($role->id === $employee->role)
                                                                    selected
                                                                @endif
                                                                >{{ $role->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-1 col-0"></div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="admin_email" class="form-label">Email Id</label>
                                                    <input type="email" class="form-control" name="admin_email" value="{{ $employee->email }}" placeholder="Email address">
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="mb-3">
                                                    <label for="admin_phone" class="form-label">Phone Number</label>
                                                    <input type="text" class="form-control" name="admin_phone" placeholder="Phone number" value="{{ $employee->phone }}"
                                                    onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                                </div>
                                            </div>
                                            <div class="col-md-1 col-0"></div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="admin_password" class="form-label">Password</label>
                                                    <input type="password" class="form-control" name="admin_password" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="mb-3">
                                                    <label for="admin_password" class="form-label w-100">Reset Password</label>
                                                    <button class="btn btn-sm btn-outline-warning w-100" class="">Reset</button>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="d-flex justify-content-end py-3">
                                        <button id="formSubmit" disabled type="submit" class="btn btn-success">Save changes</button>
                                    </div>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- core:js -->
    <script src="../../../assets/vendors/core/core.js"></script>
    <!-- endinject -->

    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->

    <!-- inject:js -->
    <script src="../../../assets/vendors/feather-icons/feather.min.js"></script>
    <script src="../../../assets/js/template.js"></script>
    <!-- endinject -->

    <script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // country
        $("#country").on('change', function () {
            const c_id = $("#country").val();
            console.log(c_id);

            const stateurl = "{{ route('get-states', ['cid' => ':cid']) }}".replace(':cid', c_id);
            $.ajax({
                url: stateurl,
                type: 'GET',
                success: function (res) {
                    let html = '<option value="" selected disabled>--select--</option>'; // Default option
                    html += res.map(state => `<option value="${state.id}" >${state.name}</option>`).join('');
                    $("#state").html(html);
                }
            })
        });

        // district
        $("#state").on('change', function () {
            const s_id = $("#state").val();
            console.log(s_id);

            const districturl = "{{ route('get-districts', ['sid' => ':sid']) }}".replace(':sid', s_id);
            $.ajax({
                url: districturl,
                type: 'GET',
                success: function (res) {
                    let html = '<option value="" selected disabled>--select--</option>'; // Default option
                    html += res.map(state => `<option value="${state.id}" >${state.name}</option>`).join('');
                    $("#district").html(html);
                }
            })
        });


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

</body>

</html>
