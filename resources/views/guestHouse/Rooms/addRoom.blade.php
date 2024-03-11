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
                                        <label for="roomNumber" class="form-label">Room Number</label>
                                        <input id="roomNumber" class="form-control" name="roomNumber" type="text" placeholder="Room number">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Price</label>
                                        <select name="price" id="price" class="form-control text-capitalize">
                                            <option value="" selected disabled>--select--</option>
                                            @foreach ($roomRates as $roomRate)
                                                <option value="{{ $roomRate->id }}">{{ $roomRate->price }} | {{ $roomRate->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="numberOfBeds" class="form-label">Number Of Beds</label>
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
                                        <input id="capacity" class="form-control" name="capacity" type="text" placeholder="Capacity" 
                                        onkeypress="return event.charCode >= 48 && event.charCode <= 57">
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
                                        <label for="roomCategory" class="form-label">Room Category</label>
                                        <select class="form-control" readOnly name="roomCategory" id="roomCategory" required>
                                            <option value="" disabled>--select--</option>
                                            @foreach ( $roomCategories as $roomCategory )
                                                <option value="{{ $roomCategory->id }}">{{ $roomCategory->name }}</option>
                                            @endforeach
                                        </select>
                                        {{-- <input id="" class="form-control" name="" type="text"> --}}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="roomDetails" class="form-label">Room Details</label>
                                        <textarea class="form-control" name="roomDetails" id="roomDetails" cols="30" rows="1"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between p-3">
                                <h5 class="text-secondary">Features <small class="fst-italic text-danger">( optional )</small></h5>
                                {{-- <button> --}}
                                <i id="viewSaasForm" style="cursor: pointer;" data-feather="chevron-down"></i>
                                <i id="hideSaasForm" style="cursor: pointer;" data-feather="chevron-up"></i>
                            </div>
                            <div class="d-block py-2 bg-light bg-opacity-25 rounded" id="saasForm">
                                <div class="table-responsive">
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
                                                    <button type="button" class="btn btn-success btn-sm" id="add-feature">add</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                {{-- <ul class="d-none" id="roomFeatureList">
                                    <li class="card p-3">
                                        <div class="card-title">Feature</div>
                                        <div class="card-body row">
                                            <div class="mb-3 row">
                                                <label for="" class="col-md-3 m-auto form-label">Select Feature</label>
                                                <div class="col-md-9">
                                                    <input type="text" class="form-control feature" list="featureLits" id="features" placeholder="Search available features">
                                                </div>
                                                <datalist id="featureLists">
                                                    <!--list body-->
                                                </datalist>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="" class="form-label col-md-4 m-auto">Description</label>
                                                <div class="col-md-8">
                                                    <textarea name="" id="description" cols="30" rows="3" class="form-control description"></textarea>
                                                </div>
                                            </div>
                                            <div class="mb-3 row">
                                                <label for="" class="form-label col-md-4 m-auto">Price</label>
                                                <div class="col-md-8">
                                                    <input type="text" name="" id="price" class="form-control price" placeholder="Price (optional)">
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
                                </ul> --}}
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

    $(document).on('click', '.remove-feature', function(){  
         $(this).parents('tr').remove();
    });

    $(document).on('click', '#add-feature', function(e){  
        e.preventDefault();
        // const featureName = $("#features").val();
        // var data = $(this).parent().siblings(".name").val();
        // console.log($(this)); // Check the clicked element
// console.log($(this).siblings()); // See the direct siblings
console.log($(this).closest("tr").children("td").children("input").find("input[name='price']"));
        // var data = $(this).closest("tr").find(".name").val(); 
        // console.log(data);
        ++i;
        $("#roomFeatureList").append(`
        <tr>
            <td>
                <input type="text" name="features['i'][name]" class="form-control name" value="a" readOnly>
            </td>
            <td>
                <textarea class="form-control" name="features['i'][description]" cols="30" rows="1" readOnly></textarea>
            </td>
            <td>
                <input type="text" name="features['i'][price]" class="form-control price" readOnly>
            </td>
            <td>
                <input type="text" name="features['i'][remarks]" class="form-control" readOnly>
            </td>
            <td>
                <button type="button" class="btn btn-danger mx-auto btn-sm remove-feature">remove</button>
            </td>
        </tr>
        `);
    });

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


        // $("#formSubmit").on('click', function(e) {
        //     // e.preventDefault();
        //     var data = $("#newRoomForm").serialize();
            // const path = "{{ route('guest-house-new-room') }}";

        //     const form = $("#newRoomForm");

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

<x-main-footer/>