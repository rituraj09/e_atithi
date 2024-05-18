<!-- resources/views/guestHouse/GuestHouse/add.blade.php -->

{{-- <x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-admin.navbar/>
            <div class="page-content">
                <x-page-header :title="'Guest House'"/>
                <div class="d-flex flex-column border card"> --}}
                    <div class="d-flex col nav nav-tabs bg-light pt-2 px-2">
                        <div>
                            <button id="guestHouseButton" class="text-capitalize nav-link active px-4 fw-bold">
                                details
                            </button>
                        </div>
                        <div>
                            <button id="employeeButton" class="text-capitalize nav-link">
                                employees
                            </button>
                        </div>
                    </div>
                    <div class="pt-3" id="guestHouseView">
                        <form class="mx-2 mx-md-3"  action="{{ route('add-new-guest-house') }}" method="POST">
                            @csrf
                            <div class="row m-0 p-0">
                                <div class="mb-3 stretch-card">
                                    <div class="w-100">
                                        <input type="file" id="myDropify"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Guest House Name</label>
                                        <input id="name" class="form-control" readonly name="name" type="text" 
                                        value="{{ $guestHouse->name }}" placeholder="Guest house name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="guestHouseType" class="form-label">Guest House Types</label>
                                        <select class="form-control" readonly name="guestHouseType" id="guestHousetype">
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
                                        <input id="email" class="form-control" readonly name="email" type="text" 
                                        value="{{ $guestHouse->official_email }}" placeholder="Official email id">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone No.</label>
                                        <input id="phone" class="form-control" readonly name="phone" type="text" value="{{ $guestHouse->contact_no }}" 
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
                                <button data-href="{{ route('edit-guest-house', ['id' => $guestHouse->id ]) }}" class="open-popup btn btn-sm btn-outline-primary">
                                    Edit
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="pt-3" id="employeeView">
                        <div class="table-responsive p-3">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Role</th>
                                        <th>Official Contacts</th>
                                        <th>Action</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!$employees)
                                        <tr>
                                            <td colspan="4">No Data</td>
                                        </tr>
                                    @endif
                                    @foreach ($employees as $employee)
                                    {{-- {{ dd($guestHouse->country_name->name) }} --}}
                                        <tr>
                                            <td>{{ $employee['admin_name'] }}</td>
                                            <td>{{ $employee->roles[0]->name }}</td>
                                            <td>{{ $employee['email'] }}</td>
                                            <td>
                                                <div class="d-flex py-0">
                                                    <a href="{{ route('edit-sub-user', ['id' => $employee->id]) }}" class="btn btn-sm btn-outline-primary">edit</a>
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
                            <div class="d-flex row px-4 py-2 rounded" id="saasForm">
                                @foreach ($employees as $employee)
                                <div class="row m-0 mb-3 border bg-white shadow-sm rounded p-4 mt-2">
                                    <div class="col-md-1 col-0 mt-2 d-sm-none d-md-block text-start">
                                        <span class="mdi mdi-account-circle fs-2"></span>
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
                                    <div class="col-md-1 col-0">
                                        <span class="mdi mdi-edit fs-5"></span>
                                    </div>
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
                                    <div class="d-none col-md-6">
                                        <div class="mb-3 ">
                                            <label for="admin_password" class="form-label">Password</label>
                                            <input type="password" class="form-control" name="admin_password" placeholder="">
                                        </div>
                                    </div>
                                    <div class="d-none col-md-5">
                                        <div class="mb-3">
                                            <label for="admin_password" class="form-label w-100">Reset Password</label>
                                            <button class="btn btn-sm btn-outline-warning w-100" class="">Reset</button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="d-flex justify-content-end py-3">
                                <a href="{{ route('add-sub-users') }}" class="btn btn-sm btn-outline-primary">
                                    Add employee
                                </a>
                                {{-- <button id="formSubmit" disabled type="submit" class="btn btn-success">Save changes</button> --}}
                            </div>
                        </div>
                    </div>

                    <x-popup/>
                {{-- </div>
            </div>
            <x-footer/>
        </div>
    </div> --}}


<script src="{{ asset('assets/vendors/dropify/dist/dropify.min.js') }}"></script>
<script src="{{ asset('assets/js/dropify.js') }}"></script>

    <script>
    $(document).ready(function() {
        $('.dropify-message p').css('font-size', '16px'); 
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




        // $("#saasForm").removeClass('d-flex').addClass('d-none');
        $("#employeeView").hide();
        $("#guestHouseView").show();

        $("#guestHouseButton").on('click', function() {
            // console.log('show');
            $("#employeeButton").removeClass('active px-4 fw-bold');
            $("#guestHouseButton").addClass('active px-4 fw-bold');
            $("#employeeView").hide();
            $("#guestHouseView").show();
        });

        $("#employeeButton").on('click', function() {
            // console.log('hide');
            $("#employeeButton").addClass('active px-4 fw-bold');
            $("#guestHouseButton").removeClass('active px-4 fw-bold');
            $("#employeeView").show();
            $("#guestHouseView").hide();
        });
    
    });

    </script>

{{-- <x-main-footer/> --}}
