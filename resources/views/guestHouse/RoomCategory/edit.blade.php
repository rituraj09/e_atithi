<!-- resources/views/profile.blade.php -->

{{-- {{ dd($roomCategories); }} --}}

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-navbar/>

            <div class="page-content">
                {{-- <div class="d-flex justify-content-between mb-3">
                    <h6 class="card-title my-auto">Manage Room Categories</h6>
                </div> --}}
                  
                <x-page-header :title="'Edit'" :prev="'Room Category'" />
                <div class="d-flex flex-column border border-dark card">
                    <div class="nav nav-tabs bg-primary bg-opacity-25 pt-2 px-2">
                        <div>
                            <a href="{{ route('room-category') }}" class="nav-link" id="view">
                                view
                            </a>
                        </div>
                        @if ($roomCategory)
                        <div>
                            <button class="nav-link active px-4 fw-bold" id="edit">
                                edit
                            </button>
                        </div>
                        @endif
                    </div>
                    <div class="table-responsive">
                        <div class="card-body" id="categoryForm">
                            <form id="newRoomForm">
                                <div class="mb-3">
                                    <label for="categoryName" class="form-label">Room Category Name</label>
                                    <input id="categoryName" class="form-control" name="categoryName" type="text" 
                                        value="{{ $roomCategory->name }}" placeholder="Room category">
                                </div>
                                <div class="d-flex pt-2">
                                    <input type="hidden" id="categoryId" value="{{ $roomCategory->id }}" name="id">
                                    {{-- @if ($roomCategory) --}}
                                        <a href="{{ route('room-category') }}" class="btn btn-sm btn-outline-primary me-2">New</a>
                                        <button id="updateCategory" class="btn btn-sm btn-success" disabled>Save changes</button>
                                    {{-- @else --}}
                                        {{-- <button id="addCategory" class="btn btn-sm btn-success">Submit</button> --}}
                                    {{-- @endif --}}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <!-- .join({{ route('edit-room-category', ['id' => `${roomCategory.name}` ]) }}) --> --}}
    <script>
    $(document).ready(function() {


        $("#categoryName").on('changeinput change', function() {
            $("#updateCategory").attr('disabled', false);
        })

        $("#updateCategory").click( (e) => {
            e.preventDefault();
            var category = $("#categoryName");
            var categoryId = $("#categoryId");
            const path = "{{ route('update-room-category') }}";

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: path,
                type: 'POST',
                data: { category: category.val(), id: categoryId.val() },
                success: function (res) {
                    console.log(res);
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                    });

                    Toast.fire({
                        icon: res.icon,
                        title: res.message,
                    })

                    if (res.icon === 'success') {
                        category.val('');
                    } 
                    loadCategory();
                }
            });
        })
        
    });

    $(document).ready( function () {
        $("#add").removeClass('active px-4 fw-bold');
        $("#view").removeClass('active px-4 fw-bold');

        $(".edit-btn").on('click', function() {
            // console.log('hide');
            $("#add").removeClass('active px-4 fw-bold');
            $("#view").removeClass('active px-4 fw-bold');
            $("#categoryForm").hide();
            $("#category").hide();
        });
    })


    var deleteUrl = ""
    $(document).on('click', '.delete-btn', function() {
        const id = $(this).data('id');
        // Confirm deletion and send AJAX request to delete route
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert !",
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

    // Handle edit button click
    $(document).on('click', '.edit-btn', function() {
        const id = $(this).data('id');
        // Check if ID is valid before redirecting
        if (isNaN(id) || id <= 0) {
            console.error('Invalid category ID:', id);
            return;
        }
        // Redirect to the edit route with the ID
        const editRoute = "{{ route('edit-room-category', ':id') }}"; // Replace with your actual route
        window.location.href = editRoute.replace(':id', id);
    });

    $(document).on('click', '#add', function(e) {
        e.preventDefault();
        $('#add').removeClass('btn-light');
        $('#view').addClass('btn-light');
        $("#categoryFrom").removeClass('d-none');
        $("#category").addClass('d-none');
    });

    $(document).on('click', '#view', function(e) {
        e.preventDefault();
        $('#view').removeClass('btn-light');
        $('#add').addClass('btn-light');
        $("#categoryFrom").addClass('d-none');
        $("#category").removeClass('d-none');
    });

    </script>

<x-main-footer/>
