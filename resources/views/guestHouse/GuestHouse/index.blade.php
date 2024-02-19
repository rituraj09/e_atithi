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
                                    <h6 class="card-title my-auto">Guest Houses</h6>
                                    <a href="{{ route('add-guest-house') }}" class="btn btn-primary shadow">
                                        <i data-feather="plus"></i>
                                        add guest house
                                    </a>
                                </div>
                                <div class="table-responsive">
                                    <table id="dataTableExample" class="table">
                                        <thead>
                                            <tr>
                                            <th>Name</th>
                                            <th>Address</th>
                                            <th>Official Contacts</th>
                                            <th>Admin</th>
                                            <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (!$guestHouses)
                                                <tr>
                                                    <td colspan="4">No Data</td>
                                                </tr>
                                            @endif
                                            @foreach ($guestHouses as $guestHouse)
                                            {{-- {{ dd($guestHouse->country_name->name) }} --}}
                                                <tr>
                                                    <td>{{ $guestHouse['name'] }}</td>
                                                    <td>
                                                        @if ($guestHouse['address'])
                                                            {{ $guestHouse['address'] }},
                                                        @endif
                                                        {{ $guestHouse['district_name']->name }},
                                                        {{ $guestHouse['state_name']->name }},
                                                        {{ $guestHouse['country_name']->name }}
                                                    </td>
                                                    <td>{{ $guestHouse['official_email'] }}</br>{{ $guestHouse['contact_no'] }}</td>
                                                    <td>{{ $guestHouse['admins'][0]->admin_name }}</td>
                                                    <td>
                                                        <div class="d-flex py-0">
                                                            <div class="px-1">
                                                                <button class="btn btn-danger btn-sm">
                                                                    {{-- <i data-feather="trash"></i> --}}
                                                                    Delete
                                                                </button>
                                                            </div>
                                                            <div class="px-1">
                                                                </button>
                                                                <a href="{{ route('edit-guest-house', ['id' => $guestHouse->id ]) }}" class="btn btn-sm btn-outline-primary">
                                                                    Edit
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
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
