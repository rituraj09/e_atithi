<!-- resources/views/profile.blade.php -->

{{-- {{ dd($guest); }} --}}

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-alerts/>
            <nav class="sidebar">
                <div class="sidebar-header">
                  <a href="#" class="sidebar-brand">
                    <span>e</span>Atithi
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
                    <div class="col-md-4 grid-margin stretch-card">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">
                                    @if ($roomCategory)
                                    Update Room Category
                                    @else 
                                    New Room Category
                                    @endif 
                                </h4>
								<form id="newRoomForm">
                                    <div class="mb-3">
                                        <label for="categoryName" class="form-label">Room Category</label>
                                        <input id="categoryName" class="form-control" name="categoryName" type="text" 
                                            value="{{ $roomCategory ? $roomCategory->name : null }}" placeholder="Room category">
                                    </div>
                                    <div class="d-flex justify-content-end pt-2">
                                        <input type="hidden" id="categoryId" value="{{ $roomCategory ? $roomCategory->id : null  }}" name="id">
                                        @if ($roomCategory)
                                            <a href="{{ route('room-category') }}" class="btn btn-outline-primary me-2">New</a>
                                            <button id="updateCategory" class="btn btn-success" disabled>Save changes</button>
                                        @else
                                            <button id="addCategory" class="btn btn-success">Submit</button>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
					<div class="col-md-8 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title my-auto">Room Categories</h6>
                                <div class="table-responsive">
                                    <table id="dataTableExample" class="table">
                                        <thead>
                                            <tr>
                                                <th>Room Category</th>
                                                <th>Rate</th>
                                                <th>Remarks</th>
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

    <!-- Custom js for this page -->
    <!-- End custom js for this page -->
    {{-- <!-- .join({{ route('edit-room-category', ['id' => `${roomCategory.name}` ]) }}) --> --}}
    <script>
    $(document).ready(function() {

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
                    // const editRoute =  "a";
                    // console.log(editRoute);

                    const html = res.data.map(data => `
                        <tr>
                            <td>${data.name}</td>
                            <td>200/-</td>
                            <td></td>
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

    </script>

</body>

</html>
