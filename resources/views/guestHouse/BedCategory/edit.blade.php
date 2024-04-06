<!-- resources/views/guestHouse/Rate/add.blade.php -->

<x-header/>
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
                    </div>
                    <div class="pt-3">
                        <form class="mx-2 mx-md-3 form" action="{{ route('store-bed-category') }}" method="POST">
                            @csrf
                            <div class="row m-0 p-0">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input id="name" class="form-control" name="name" type="text" placeholder="Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Occupancy</label>
                                        <input id="price" class="form-control" name="occupancy" type="text" placeholder="Price modifier">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Price Modifier</label>
                                        <input id="price" class="form-control" name="price_modifier" type="text" placeholder="Price modifier">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    {{-- <div class="mb-3"> --}}
                                        <label for="price" class="form-label">Remarks</label>
                                        <textarea class="form-control" name="remarks" id="" cols="30" rows="1"></textarea>
                                    {{-- </div> --}}
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