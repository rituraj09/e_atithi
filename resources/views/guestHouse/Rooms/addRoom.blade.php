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
                                        <form id="newRoomForm" class="mx-2 mx-md-3">
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
                                                        <label for="capacity" class="form-label">Capacity</label>
                                                        <input id="capacity" class="form-control" name="capacity" type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
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

                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <td>Name</td>
                                                            <td>Description</td>
                                                            <td>Price</td>
                                                            <td>Remarks</td>
                                                            <td>Action</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="table-group-divider" id="roomFeatureList">
                                                        <tr>
                                                            <td>
                                                                <input type="text" name="features[0][name]" id="" class="form-control">
                                                            </td>
                                                            <td>
                                                                <textarea class="form-control" name="features[0][description]" id="" cols="30" rows="1"></textarea>
                                                            </td>
                                                            <td>
                                                                <input type="text" name="features[0][price]" id="price" class="form-control">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="features[0][remarks]" id="" class="form-control">
                                                            </td>
                                                            <td>
                                                                <button class="btn btn-success btn-sm" id="add-feature">add</button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                                <ul id="roomFeatureList">
                                                    <li class="d-none card p-3">
                                                        <div class="card-title">Feature</div>
                                                        <div class="card-body row">
                                                            <div class="mb-3 row">
                                                                <label for="" class="col-md-3 m-auto form-label">Select Feature</label>
                                                                <div class="col-md-9">
                                                                    <input type="text" class="form-control" list="featureLits" id="features" placeholder="Search available features">
                                                                </div>
                                                                <datalist id="featureLists">
                                                                    <!--list body-->
                                                                </datalist>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <label for="" class="form-label col-md-4 m-auto">Description</label>
                                                                <div class="col-md-8">
                                                                    <textarea name="" id="" cols="30" rows="3" class="form-control"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <label for="" class="form-label col-md-4 m-auto">Price</label>
                                                                <div class="col-md-8">
                                                                    <input type="text" name="" id="price" class="form-control" placeholder="Price (optional)">
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 row">
                                                                <label for="" class="form-label col-md-4 m-auto">Remarks</label>
                                                                <div class="col-md-8">
                                                                    <input type="text" name="" id="remarks" class="form-control" placeholder="Remarks (optional)">
                                                                </div>
                                                            </div>
                                                            <button class="btn btn-sm btn-primary" id="add-feature">add</button>
                                                        </div>
                                                    </li>
                                                </ul>


                                                {{-- @for ( $a = 0; $a < 0; $a++ )
                                                <div class="col-12 col-md-6 p-2 px-3">
                                                    <div class="d-flex bg-white shadow rounded-3 p-3">
                                                        <div class="col-8">
                                                            <label class="w-100 pe-2">Bathroom attached</label>
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
                                                @endfor  --}}
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
                </div>
            </div>
        </div>
    </div>


    <script>


    $(document).ready(function() {
        var i = 0;
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

        $("#add-feature").on('click', function (e) {
            e.preventDefault();
            const featureName = $("#features").val();

            ++i;

            $("#roomFeatureList").append(`
            <tr>
                <td>
                    <input type="text" name="features['i'][name]" class="form-control">
                </td>
                <td>
                    <textarea class="form-control" name="features['i'][description]" cols="30" rows="1"></textarea>
                </td>
                <td>
                    <input type="text" name="features['i'][price]" class="form-control price">
                </td>
                <td>
                    <input type="text" name="features['i'][remarks]" class="form-control">
                </td>
                <td>
                    <button type="button" class="btn btn-danger mx-auto btn-sm remove-feature">remove</button>
                </td>
            </tr>
            `);


            // $.ajax({
            //     url: '',
            //     type: 'POST',
            //     data: {featureName:featureName},
            //     success: function(res) {
            //         console.log(res);
            //     }
            // })
        });

        $(".remove-feature").on('click', function(e) {
            e.preventDefault();
            $(this).parents('tr').remove();
            console.log('remove');
            // $(this).remove();
            // $("#roomFeatureList").
        });


        // $("#saasForm").removeClass('d-flex').addClass('d-none');
        $("#saasForm").hide();
        $("#viewSaasForm").show();
        $("#hideSaasForm").hide();

        $("#viewSaasForm").on('click', function() {
            // console.log('show');
            // $("#saasForm").removeClass('d-none').addClass('d-flex');
            $("#saasForm").show();
            $("#viewSaasForm").hide();
            $("#hideSaasForm").show();
        });

        $("#hideSaasForm").on('click', function() {
            // console.log('hide');
            // $("#saasForm").removeClass('d-flex').addClass('d-none');
            $("#saasForm").hide();
            $("#viewSaasForm").show();
            $("#hideSaasForm").hide();
        });


        $("#formSubmit").on('click', function(e) {
            e.preventDefault();
            var data = $("#newRoomForm").serialize();
            const path = '';

            const form = $("#newRoomForm");

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

<x-main-footer/>