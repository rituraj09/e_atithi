<!-- resources/views/guestHouse/GuestHouse/add.blade.php -->

<!-- resources/views/guestHouse/GuestHouse/index.blade.php -->

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-navbar/>

            <div class="page-content">
                <x-page-header :title="'Add'" :prev="'Manage Guest House'"/>
                <div class="d-flex flex-column border card">
                    <div class="d-flex col nav nav-tabs bg-light pt-2 px-2">
                        <div>
                            <a href="{{ route('all-guest-house') }}" class="text-capitalize nav-link">
                                view
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('add-guest-house') }}" class="text-capitalize nav-link active px-4 fw-bold">
                                add
                            </a>
                        </div>
                    </div>
                    <div class="pt-3">
                        <form class="mx-2 mx-md-3" id="newRoomForm" action="{{ route('add-new-guest-house') }}" method="POST">
                            @csrf
                            <div class="row m-0 p-0">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Guest House Name</label>
                                        <input id="name" class="form-control" name="name" type="text" placeholder="Guest house name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="guestHouseType" class="form-label">Guest House Types</label>
                                        <select class="form-control" name="guestHouseType" id="guestHousetype">
                                            <option value="" selected disabled>--select--</option>
                                            @foreach ( $guestHouseTypes as $guestHouseType )
                                                <option value="{{ $guestHouseType->id }}">{{ $guestHouseType->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Official Email</label>
                                        <input id="email" class="form-control" name="email" type="text" placeholder="Official email id">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Phone No.</label>
                                        <input id="phone" class="form-control" name="phone" type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="official contact no">
                                    </div>
                                </div>
                                {{-- address --}}
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <input id="address" class="form-control" name="address" type="text" placeholder="optional">
                                    </div>
                                </div>
                                {{-- country --}}
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="country" class="form-label">Country</label>
                                        <select class="form-control" name="country" id="country">
                                            <option value="" selected disabled>--select--</option>
                                            @foreach ( $countries as $country )
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- state --}}
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="state" class="form-label">State</label>
                                        <select class="form-control" name="state" id="state">
                                            <option value="" selected disabled>--select--</option>
                                        </select>
                                    </div>
                                </div>
                                {{-- district --}}
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="district" class="form-label">District</label>
                                        <select class="form-control" name="district" id="district">
                                            <option value="" selected disabled>--select--</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="pin" class="form-label">PIN</label>
                                        <input id="pin" class="form-control" name="pin" type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="Pin no">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6 stretch-card">
                                    <div class="card fs-6">
                                        <div class="card-body">
                                            <h6 class="card-title">Guest House Image</h6>
                                            {{-- <p class="text-muted mb-3">Read the <a href="https://github.com/JeremyFagis/dropify" target="_blank"> Official Dropify Documentation </a>for a full list of instructions and other options.</p> --}}
                                            <input type="file" id="myDropify"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between p-3">
                                <h5 class="text-secondary">Admin</h5>
                            </div>
                            <div class="d-flex row px-4 py-2 pt-3 bg-light bg-opacity-25 rounded" id="saasForm">
                                <div class="row m-0">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="admin_name" class="form-label">Admin Name</label>
                                            <input type="text" class="form-control" name="admin_name" placeholder="Admin name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="admin_role" class="form-label">Role</label>
                                            <select name="admin_role" id="admin_role" class="form-control" disabled>
                                                <option value="2" selected disabled>admin</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="admin_email" class="form-label">Email Id</label>
                                            <input id="admin_email" type="email" class="form-control" name="admin_email" placeholder="Email address">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="admin_phone" class="form-label">Phone Number</label>
                                            <input id="admin_phone" type="text" class="form-control" name="admin_phone" placeholder="Phone number" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                        </div>
                                    </div>
                                    <div class="d-none col-md-6">
                                        <div class="mb-3">
                                            <label for="admin_password" class="form-label">Password</label>
                                            <input type="password" class="form-control" name="admin_password" placeholder="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end py-3">
                                <button id="formSubmit" type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <x-footer/>
        </div>
    </div>

    <!-- Custom js for this page -->
    <script>
    $(document).ready( function () {
        // common csrf header
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        const deleteUrl = "{{ route('delete-room-category')}}";
        $(".ask-delete").on('click', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert !" + id,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: deleteUrl,
                        type: "POST",
                        data: {id:id},
                        success: function(res) {
                            console.log(res)
                        }
                    })
                    Swal.fire({
                    title: "Deleted!",
                    text: "id" + id,
                    icon: "success"
                    });
                }
            });
        });
    })
    </script>

<x-main-footer/>




@php
/*
<body >
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
								<h4 class="card-title">New Guest House</h4>
								<form id="newRoomForm" action="{{ route('add-new-guest-house') }}" method="POST">
                                    @csrf
                                    <div class="row m-0 p-0">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Guest House Name</label>
                                                <input id="name" class="form-control" name="name" type="text" placeholder="Guest house name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="guestHouseType" class="form-label">Guest House Types</label>
                                                <select class="form-control" name="guestHouseType" id="guestHousetype">
                                                    <option value="" selected disabled>--select--</option>
                                                    @foreach ( $guestHouseTypes as $guestHouseType )
                                                        <option value="{{ $guestHouseType->id }}">{{ $guestHouseType->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Official Email</label>
                                                <input id="email" class="form-control" name="email" type="text" placeholder="Official email id">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Phone No.</label>
                                                <input id="phone" class="form-control" name="phone" type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="official contact no">
                                            </div>
                                        </div>
                                        {{-- address --}}
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="address" class="form-label">Address</label>
                                                <input id="address" class="form-control" name="address" type="text" placeholder="optional">
                                            </div>
                                        </div>
                                        {{-- country --}}
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="country" class="form-label">Country</label>
                                                <select class="form-control" name="country" id="country">
                                                    <option value="" selected disabled>--select--</option>
                                                    @foreach ( $countries as $country )
                                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        {{-- state --}}
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="state" class="form-label">State</label>
                                                <select class="form-control" name="state" id="state">
                                                    <option value="" selected disabled>--select--</option>
                                                </select>
                                            </div>
                                        </div>
                                        {{-- district --}}
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="district" class="form-label">District</label>
                                                <select class="form-control" name="district" id="district">
                                                    <option value="" selected disabled>--select--</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="pin" class="form-label">PIN</label>
                                                <input id="pin" class="form-control" name="pin" type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="Pin no">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6 stretch-card">
                                            <div class="card fs-6">
                                                <div class="card-body">
                                                    <h6 class="card-title">Guest House Image</h6>
                                                    {{-- <p class="text-muted mb-3">Read the <a href="https://github.com/JeremyFagis/dropify" target="_blank"> Official Dropify Documentation </a>for a full list of instructions and other options.</p> --}}
                                                    <input type="file" id="myDropify"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between p-3">
                                        <h5 class="text-secondary">Admin</h5>
                                    </div>
                                    <div class="d-flex row px-4 py-2 pt-3 bg-light bg-opacity-25 rounded" id="saasForm">
                                        <div class="row m-0">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="admin_name" class="form-label">Admin Name</label>
                                                    <input type="text" class="form-control" name="admin_name" placeholder="Admin name">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="admin_role" class="form-label">Role</label>
                                                    <select name="admin_role" id="admin_role" class="form-control" disabled>
                                                        <option value="2" selected disabled>admin</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="admin_email" class="form-label">Email Id</label>
                                                    <input type="email" class="form-control" name="admin_email" placeholder="Email address">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="admin_phone" class="form-label">Phone Number</label>
                                                    <input type="text" class="form-control" name="admin_phone" placeholder="Phone number" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                                </div>
                                            </div>
                                            <div class="d-none col-md-6">
                                                <div class="mb-3">
                                                    <label for="admin_password" class="form-label">Password</label>
                                                    <input type="password" class="form-control" name="admin_password" placeholder="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end py-3">
                                        <button id="formSubmit" type="submit" class="btn btn-success">Submit</button>
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
    <script src="../../../assets/vendors/dropify/dist/dropify.min.js"></script>
    <script src="../../../assets/js/dropify.js"></script>
    <!-- End plugin js for this page -->

    <!-- inject:js -->

	<script src="../../../assets/vendors/jquery-validation/jquery.validate.min.js"></script>
    <script src="../../../assets/vendors/feather-icons/feather.min.js"></script>
    <script src="../../../assets/js/template.js"></script>
    <!-- endinject -->

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
            $("#district").html(`<option selected disabled>--select--</option>`);

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
        $("#viewSaasForm").show();
        $("#hideSaasForm").hide();

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


        // $("#formSubmit").on('click', function(e) {
        //     e.preventDefault();
        //     var data = $("#newRoomForm").serialize();
        //     const path = '';

        //     console.log(data)

            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });

            // $.ajax({
            //     url: path,
            //     type: 'POST',
            //     data: {data: data},
            //     success: function(res) {
            //         console.log(res);
            //     }
            // });

        // })
    
    });

    </script>

</body>

</html>
*/
@endphp
