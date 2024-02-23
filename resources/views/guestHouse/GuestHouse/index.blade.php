<!-- resources/views/guestHouse/GuestHouse/index.blade.php -->

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
                                <div class="d-flex justify-content-between mb-3">
                                    <h6 class="card-title my-auto">Manage Guest Houses</h6>
                                    <a href="{{ route('add-guest-house') }}" class="d-none btn btn-primary btn-icon-text shadow">
                                        <i class="btn-icon-prepend" data-feather="plus"></i>
                                        add guest house
                                    </a>
                                </div>
                                <div class="d-flex flex-column border">
                                    <div class="d-flex col">
                                        <div>
                                            <a href="{{ route('all-guest-house') }}" class="btn rounded">
                                                view
                                            </a>
                                        </div>
                                        <div>
                                            <a href="{{ route('add-guest-house') }}" class="btn bg-light rounded-0">
                                                add
                                            </a>
                                        </div>
                                        <div class="col border"></div>
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
                                                <th>Status</th>
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
                                                                    <button class="btn btn-info btn-sm" data-id="{{$guestHouse->id}}">
                                                                        {{-- <i data-feather="trash"></i> --}}
                                                                        View
                                                                    </button>
                                                                </div>
                                                                <div class="px-1">
                                                                    <a href="{{ route('edit-guest-house', ['id' => $guestHouse->id ]) }}" class="btn btn-sm btn-outline-primary">
                                                                        Edit
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-check form-switch px-auto me-0">
                                                                <input type="checkbox" class="form-check-input" id="formSwitch1">
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
