<!-- resources/views/profile.blade.php -->

{{-- {{ dd($roomCategories); }} --}}

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-admin.navbar/>

            <div class="page-content">
                <x-page-header :title="'Manage Room Categories'" />
                <div class="d-flex flex-column border card">
                    <div class="nav nav-tabs bg-light pt-2 px-2">
                        <div>
                            <button class="text-capitalize nav-link active px-4 fw-bold" id="view">
                                view
                            </button>
                        </div>
                        <div>
                            <button class="text-capitalize nav-link" id="add">  
                                add
                            </button>
                        </div>
                        @if ($roomCategory)
                        <div>
                            <button class="text-capitalize nav-link active px-4 fw-bold" id="edit">
                                edit
                            </button>
                        </div>
                        @endif
                    </div>
                    <div>
                        @if ($roomCategory)
                        <div class="card-body categoryForm">
                            <form id="newRoomForm">
                                <div class="mb-3">
                                    <label for="categoryName" class="form-label">Room Category Name</label>
                                    <input id="categoryName" class="form-control" name="categoryName" type="text" 
                                        value="{{ $roomCategory ? $roomCategory->name : null }}" placeholder="Room category">
                                </div>
                                <div class="d-flex pt-2">
                                    <input type="hidden" id="categoryId" value="{{ $roomCategory ? $roomCategory->id : null  }}" name="id">
                                    @if ($roomCategory)
                                        <a href="{{ route('room-category') }}" class="btn btn-sm btn-outline-primary me-2">New</a>
                                        <button id="updateCategory" class="btn btn-sm btn-success" disabled>Save changes</button>
                                    @else
                                        <button id="addCategory" class="btn btn-sm btn-success">Submit</button>
                                    @endif
                                </div>
                            </form>    
                        </div>
                        @endif
                        <div class="table-responsive category">
                            <table class="table" id="dataTableExample">
                                <thead>
                                    <tr>
                                        <th>Room Category</th>
                                        <th>Rooms</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="categoryList">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <!-- .join({{ route('edit-room-category', ['id' => `${roomCategory.name}` ]) }}) --> --}}
    <script>
    $(document).ready(function() {
        $('#view').removeClass('btn-light');

        function loadCategory () {
            var getCategoryPath = "{{ route('get-all-room-categories') }}";
            var categoryList = $("#categoryList");
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: getCategoryPath,
                type: 'GET',
                success: function (res) {
                    console.log(res)

                    const html = res.data.map(data => `
                        <tr>
                            <td>${data.name}</td>
                            <td>
                                <div class="d-flex py-0" id="${data.id}rooms">
                                    
                                </div>    
                            </td>
                            <td>
                                <div class="d-flex py-0">
                                    <div class="px-1">
                                        <button class="btn btn-danger btn-sm py-1 delete-btn" data-id="${data.id}">
                                            delete
                                        </button>
                                    </div>
                                    <div class="px-1">
                                        <button data-id="${data.id}" class="btn btn-primary btn-sm py-1 edit-btn">
                                            edit
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>`).join('');
                    categoryList.html(html);

                    res.data.map(data => {
                        var rooms = data.rooms.map(room => `
                        <div class="px-1">
                            <small class="badge bg-success">
                                ${room.name}
                            </small>
                        </div>
                        `).join('');
                        $(`#${data.id}rooms`).html(rooms);
                    })
                    
                }
            });
        }

        loadCategory();


        $("#addCategory").click( (e) => {
            e.preventDefault();
            var category = $("#categoryName");
            const path = "{{ route('new-room-category') }}";

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: path,
                type: 'POST',
                data: { category: category.val() },
                success: function (res) {
                    console.log(res);
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                    });

                    if (res.message === 'Room category added successfully') {
                        Toast.fire({
                            icon: 'success',
                            title: res.message,
                        })
                        category.val('');
                    } else if (res.message === 'Room category already exists for this guest house') {
                        Toast.fire({
                            icon: 'warning',
                            title: res.message,
                        })
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: res.message,
                        })
                    }
                    loadCategory();
                }
            });
        })

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
        $(".categoryForm").hide();
        $(".category").show();

        $("#view").on('click', function() {
            // console.log('show');
            $("#add").removeClass('active px-4 fw-bold');
            $("#view").addClass('active px-4 fw-bold');
            $(".categoryForm").hide();
            $(".category").show();
        });

        $("#add").on('click', function() {
            // console.log('hide');
            $("#add").addClass('active px-4 fw-bold');
            $("#view").removeClass('active px-4 fw-bold');
            $(".categoryForm").show();
            $(".category").hide();
        });

        $(".edit-btn").on('click', function() {
            // console.log('hide');
            $("#add").removeClass('active px-4 fw-bold');
            $("#view").removeClass('active px-4 fw-bold');
            $(".categoryForm").hide();
            $(".category").hide();
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
