<!-- resources/views/profile.blade.php -->

{{-- {{ dd($roomCategories ); }} --}}

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-navbar/>

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

            <div class="page-content">
                <div class="row">
					<div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <x-page-header :title="'Manage Rooms'"/>
                                <div class="d-flex flex-column border border-dark">
                                    <div class="d-flex col nav nav-tabs bg-light pt-2 px-2">
                                        <div>
                                            <a href="{{ route('guest-house-admin-rooms') }}" class="nav-link">
                                                view
                                            </a>
                                        </div>
                                        <div>
                                            <a href="{{ route('guest-house-admin-add-room') }}" class="nav-link active px-4 fw-bold">
                                                add
                                            </a>
                                        </div>
                                    </div>
                                    <div class="pt-3">
                                        <form id="newRoomForm mx-2 mx-md-3">
                                            <div class="row m-0 p-0">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="roomNumber" class="form-label">Room Number</label>
                                                        <input id="roomNumber" class="form-control" name="roomNumber" type="text">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="roomCategory" class="form-label">Room Category</label>
                                                        <select class="form-control" name="roomCategory" id="roomCategory">
                                                            <option value="" selected disabled>--select--</option>
                                                            @foreach ( $roomCategories as $roomCategory )
                                                                <option value="{{ $roomCategory->id }}">{{ $roomCategory->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        {{-- <input id="" class="form-control" name="" type="text"> --}}
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="numberOfBeds" class="form-label">Number Of Beds</label>
                                                        <input id="numberOfBeds" class="form-control" name="numberOfBeds" type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="roomDetails" class="form-label">Room Details</label>
                                                        <textarea class="form-control" name="roomDetails" id="roomDetails" cols="30" rows="2"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between p-3">
                                                <h5 class="text-secondary">Features <small class="fst-italic text-danger">( optional )</small></h5>
                                                {{-- <button> --}}
                                                <i id="viewSaasForm" style="cursor: pointer;" data-feather="chevron-down"></i>
                                                <i id="hideSaasForm" style="cursor: pointer;" data-feather="chevron-up"></i>
                                            </div>
                                            <div class="d-flex row m-0 px-4 py-2 bg-light bg-opacity-25 rounded" id="saasForm">
                                                @for ( $a = 0; $a < 10; $a++ )
                                                <div class="col-12 col-md-6 p-2 px-3">
                                                    <div class="d-flex bg-white shadow rounded-3 p-3">
                                                        <div class="col-8">
                                                            <label class="w-100 pe-2">Bathroom attached</label>
                                                            {{-- <small class="text-danger col-12">optional</small> --}}
                                                        </div>
                                                        <div class="input-group col m-auto">
                                                            <div class="form-check pe-3 py-1">
                                                                <input class="form-check-input" type="radio" name="bathroom" id="bathroomYes" value="1">
                                                                <label for="bathroomYes" class="form-check-label">Yes</label>
                                                            </div>
                                                            <div class="form-check py-1">
                                                                <input class="form-check-input" default type="radio" name="bathroom" id="nathroomNo" value="0">
                                                                <label for="bathroomNo" class="form-check-label">No</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endfor
                                            </div>
                                            <div class="d-flex justify-content-end py-3 px-3">
                                                <button id="formSubmit" class="btn btn-success">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
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


        $("#formSubmit").on('click', function(e) {
            e.preventDefault();
            var data = $("#newRoomForm").serialize();
            const path = '';

            console.log(data)

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

        })
    
    });

    </script>

</body>

</html>
