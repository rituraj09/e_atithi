<!-- resources/views/profile.blade.php -->

{{-- {{ dd($roomCategories ); }} --}}

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-admin.navbar/>

            <div class="page-content">
                <x-page-header :prev="'Manage Features'" :title="'Add'"/>
                <div class="d-flex flex-column border card">
                    <div class="d-flex col nav nav-tabs bg-light pt-2 px-2">
                        <div>
                            <a href="{{ route('guest-house-room-features') }}" class="text-capitalize nav-link">
                                view
                            </a>
                        </div>
                        <div>
                            <button class="text-capitalize nav-link active px-4 fw-bold">
                                add
                            </button>
                        </div>
                    </div>
                    <div class="pt-3">
                        <form id="newRoomForm" action="{{ route('new-room-features') }}" method="POST" class="mx-3 mx-md-3" >
                            @csrf
                            <div class="d-block py-2" >
                                <div class="col-md-8 mx-auto">
                                    <div class="mb-3">
                                        <label for="fname" class="form-label">Feature's name <x-required/> </label>
                                        <input type="text" id="fname" class="form-control" name="name" placeholder="Feature's name">
                                        @error('name')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea name="description" id="description" cols="30" rows="3" class="form-control"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Price <x-required/> </label>
                                        <input type="text" class="form-control" id="price" name="price" placeholder="Price modifier">
                                        @error('price')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="remarks" class="form-label">Remarks</label>
                                        <textarea name="remarks" id="remarks" cols="30" rows="3" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-5 col-md-4 mx-auto">
                                <button class="btn btn-success w-100">Save</button>
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
        $(this).replaceWith(`
            <button type="button" class="btn btn-danger mx-auto btn-sm remove-feature">remove</button>
        `);
        // console.log($(this).closest("tr").children("td").children("input").find("input[name='price']"));

        ++i;
        $("#roomFeatureList").append(`
        <tr>
            <td>
                <input type="text" name="features[${i}][name]" class="form-control name" >
            </td>
            <td>
                <textarea class="form-control" name="features[${i}][description]" cols="30" rows="1" ></textarea>
            </td>
            <td>
                <input type="text" name="features[${i}][price]" class="form-control price" >
            </td>
            <td>
                <input type="text" name="features[${i}][remarks]" class="form-control" >
            </td>
            <td>
                <button type="button" class="btn btn-success btn-sm" id="add-feature">add</button>
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


        $("#formSubsmit").on('click', function(e) {
            e.preventDefault();
            // var data = $("#newRoomForm").serialize();
            
            const form = $("#newRoomForm");
            var formData = new FormData(form);


            // console.log(formData)

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: path, // Replace with your controller route
                type: 'POST',
                data: formData, // Or data if using manual retrieval
                processData: false, // Required for FormData
                contentType: false, // Required for FormData
                success: function(response) {
                    // Handle successful response
                    console.log(response); // Log the response for debugging
                    // Display success message or redirect
                },
                error: function(error) {
                    // Handle error response
                    console.error(error); // Log the error for debugging
                    // Display error message
                }
            });


            // $.ajax({
            //     url: path,
            //     type: 'POST',
            //     data: {data:data},
            //     success: function(res) {
            //         console.log(res);
            //     }
            // });

        })
    
    });

    </script>

<x-main-footer/>