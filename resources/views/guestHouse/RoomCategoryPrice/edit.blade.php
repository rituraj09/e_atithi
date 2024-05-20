<!-- resources/views/profile.blade.php -->

{{-- {{ dd($roomCategory); }} --}}

{{-- <x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-admin.navbar/>

            <div class="page-content">
                  
                <x-page-header :title="'Edit'" :prev="'Room Category'" />
                <div class="d-flex flex-column border card">
                    <div class="nav nav-tabs bg-light pt-2 px-2">
                        <div>
                            <a href="{{ route('room-category-price') }}" class="nav-link">
                                view
                            </a>
                        </div>
                        <div>
                            <button class="nav-link active px-4 fw-bold">
                                edit
                            </button>
                        </div>
                    </div>
                    <div class="table-responsive"> --}}
                        <div class="card-body" id="categoryForm">
                            <form action="{{ route('update-room-category-price') }}" method="POST">
                            @csrf
                                <input type="hidden" name="id" value="{{ $roomCategory->id }}">
                                <div class="mb-3">
                                    <label for="categoryName" class="form-label">Room Category Name <x-required/> </label>
                                    <input id="categoryName" class="form-control" name="categoryName" type="text" 
                                        value="{{ $roomCategory->Category->name }}" placeholder="Room category" readonly disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Price Modifier <x-required/> </label>
                                    <input id="price" type="text" class="form-control" name="price_modifier" value="{{ $roomCategory->price_modifier }}" placeholder="Price modifier">
                                </div>
                                <div class="d-flex pt-2">
                                    {{-- <input type="hidden" id="categoryId" value="{{ $roomCategory->id }}" name="id"> --}}
                                    {{-- <a href="{{ route('add-room-category-price') }}" class="btn btn-sm btn-outline-primary me-2">New</a> --}}
                                    <button id="updateCategory" class="btn btn-sm btn-success" disabled="true">Save changes</button>
                                </div>
                            </form>
                        </div>
                    {{-- </div>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- <!-- .join({{ route('edit-room-category', ['id' => `${roomCategory.name}` ]) }}) --> --}}

    <script>
        $(document).ready( function () {
            $("#price").on("input", function() {
                // Regular expression to allow only numbers, optional decimal point, and up to 2 decimal places
                const regex = /^\d+(\.\d{0,2})?$/;

                // Check if the entered value matches the regular expression
                const isValid = regex.test($(this).val());

                // Set error message and style based on validity
                if (isValid) {
                    $("#updateCategory").attr('disabled', false);
                    $(this).removeClass("error");
                    $(this).siblings(".error-message").remove(); // Remove existing error message if present
                } else {
                    $("#updateCategory").attr('disabled', true);
                    $(this).addClass("error");
                    $(this).siblings(".error-message").remove();
                    // Add error message next to the input field
                    $(this).after("<span class='error-message text-danger'><small>Please enter a valid price. Format: 0.00<small/></span>");
                }
            });
        });
    </script>

{{-- <x-main-footer/> --}}
