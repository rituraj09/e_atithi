<!-- resources/views/profile.blade.php -->

{{-- {{ dd($guest); }} --}}

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
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
					<div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h6 class="card-title my-auto">Rooms</h6>
                                    <a href="{{ route('guest-house-admin-add-room') }}" class="btn btn-primary shadow">
                                        <i data-feather="plus"></i>
                                        add user
                                    </a>
                                </div>
                                <div class="table-responsive">
                                    <table id="dataTableExample" class="table">
                                        <thead>
                                            <tr>
                                            <th>Name</th>
                                            <th>Role Type</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                            <td>R 101</td>
                                            <td>VIP</td>
                                            <td>200.00/-</td>
                                            <td>
                                                <div class="d-flex py-0">
                                                    <div class="px-1">
                                                        <button class="btn btn-danger btn-sm">
                                                            {{-- <i data-feather="trash"></i> --}}
                                                            Delete
                                                        </button>
                                                    </div>
                                                    <div class="px-1">
                                                        <button class="btn btn-primary btn-sm">
                                                            {{-- <i data-feather="edit"></i> --}}
                                                            Edit
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                            </tr>
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

</body>

</html>
