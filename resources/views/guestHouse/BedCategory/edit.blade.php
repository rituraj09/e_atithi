<!-- resources/views/guestHouse/Rate/add.blade.php -->

{{-- {{ dd($bedCategory); }} --}}

{{-- <x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-admin.navbar/>

            <div class="page-content">
                <x-page-header :prev="'Manage Bed Categories'" title="Add"/>
                <div class="d-flex flex-column border card">
                    <div class="d-flex col nav nav-tabs bg-light pt-2 px-2">
                        <div>
                            <a href="{{ route('bed-categories') }}" class="text-capitalize nav-link">
                                view
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('add-bed-category') }}" class="text-capitalize nav-link active px-4 fw-bold">
                                add
                            </a>
                        </div>
                    </div> --}}
                    <div class="pt-3">
                        <form class="mx-2 mx-md-3 form" action="{{ route('update-bed-category') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $bedCategory->id }}">
                            <div class="row m-0 p-0">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Bed Type</label>
                                        <input class="form-control" type="text" value="{{ $bedCategory->bed->name }}" readonly disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Price Modifier <x-required/> </label>
                                        <input id="price" class="form-control" name="price_modifier" type="text" value="{{ $bedCategory->price_modifier }}" placeholder="Price modifier">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    {{-- <div class="mb-3"> --}}
                                        <label for="price" class="form-label">Remarks</label>
                                        <textarea class="form-control" name="remarks" id="" cols="30" rows="1">{{ $bedCategory->remarks }}</textarea>
                                    {{-- </div> --}}
                                </div>
                            </div>
                            <div class="d-flex justify-content-end py-3">
                                <button id="formSubmit" type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                {{-- </div>
            </div>
        </div>
    </div> --}}

<script>
    $(document).ready( function () {
        $("#price").on("input", function() {
            // Regular expression to allow only numbers, optional decimal point, and up to 2 decimal places
            const regex = /^\d+(\.\d{0,2})?$/;

            // Check if the entered value matches the regular expression
            const isValid = regex.test($(this).val());

            // Set error message and style based on validity
            if (isValid) {
                $(this).removeClass("error");
                $(this).siblings(".error-message").remove(); // Remove existing error message if present
            } else {
                $(this).addClass("error");
                $(this).siblings(".error-message").remove();
                // Add error message next to the input field
                $(this).after("<span class='error-message text-danger'><small>Please enter a valid price. Format: 0.00<small/></span>");
            }
        });
    });
</script>

{{-- <x-main-footer/> --}}