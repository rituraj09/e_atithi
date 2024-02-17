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

                                                    {{-- @foreach ( $guestHouseTypes as $guestHouseType )
                                                        <option value="{{ $guestHouseType->id }}">{{ $guestHouseType->name }}</option>
                                                    @endforeach --}}
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
                                    <div class="d-flex justify-content-between p-3">
                                        <h5 class="text-secondary">Users <small class="fst-italic text-danger">( optional )</small></h5>
                                        {{-- <button> --}}
                                        <i id="viewSaasForm" style="cursor: pointer;" data-feather="chevron-down"></i>
                                        <i id="hideSaasForm" style="cursor: pointer;" data-feather="chevron-up"></i>
                                    </div>
                                    <div class="d-flex row px-4 py-2 bg-light bg-opacity-25 rounded" id="saasForm">
                                        <div class="p-2">
                                            Name/Role
                                        </div>
                                        @for ( $a = 0; $a < 10; $a++ )
                                        <div class="mb-2">
                                            <div class="d-flex bg-white shadow rounded-3 p-3">
                                                <div class="col">
                                                    Name
                                                </div>
                                                <div class="col">
                                                    Admin
                                                </div>
                                                <div class="col">
                                                    Email@
                                                </div>
                                                <div class="col">
                                                    897643
                                                </div>
                                                <div class="d-flex col m-auto">
                                                    <a href="" class="btn btn-sm btn-danger p-1 mx-1">delete</a>
                                                    <a href="" class="btn btn-sm btn-success p-1 px-2 mx-1">view</a>
                                                </div>
                                            </div>
                                        </div>
                                        @endfor
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





        $("#saasForm").removeClass('d-flex').addClass('d-none');
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
