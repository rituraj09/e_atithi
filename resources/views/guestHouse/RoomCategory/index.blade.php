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
								<h4 class="card-title">New Room Category</h4>
								<form id="newRoomForm">
                                    <div class="mb-3">
                                        <label for="categoryName" class="form-label">Room Category</label>
                                        <input id="categoryName" class="form-control" name="categoryName" type="text" placeholder="Room category">
                                    </div>
                                    <div class="d-flex justify-content-end pt-2">
                                        <button id="addCategory" class="btn btn-success">Submit</button>
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
                                            {{-- <tr>
                                                <td>VIP</td>
                                                <td>200/-</td>
                                                <td></td>
                                                <td>
                                                    <div class="d-flex py-0">
                                                        <div class="px-1">
                                                            <button class="btn btn-danger btn-sm">Delete</button>
                                                        </div>
                                                        <div class="px-1">
                                                            <button class="btn btn-primary btn-sm">Edit</button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr> --}}
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
                    const html = res.data.map(data => `
                        <tr>
                            <td>${data.name}</td>
                            <td>200/-</td>
                            <td></td>
                            <td>
                                <div class="d-flex py-0">
                                    <div class="px-1">
                                        <button class="btn btn-danger btn-sm py-1">
                                            <i data-feather="trash"></i>
                                            Delete
                                        </button>
                                    </div>
                                    <div class="px-1">
                                        <input type="button" class="btn btn-primary btn-sm py-1 editCategory" value="edit">
                                        <input type="hidden" value="${data.id }" id="categoryId">
                                    </div>
                                </div>
                            </td>
                        </tr>`).join('');
                    categoryList.html(html);
                }
            });
        }

        loadCategory();

        $(".editCategory").on('click', function(e) {
            e.preventDefault();
            var cid = $(this).siblings("#categoryId").val();
            console.log(cid);
        });

        $("#addCategory").click( (e) => {
            e.preventDefault();
            var category = $("#categoryName");
            const path = "{{ route('guest-house-admin-add-room-category') }}";

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
    });
    </script>

</body>

</html>
