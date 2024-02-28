<!-- resources/views/guestHouse/GuestHouse/view.blade.php -->

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-navbar/>

            <div class="page-content">
                <x-page-header :title="'Manage Guest Houses'"/>
                <div class="d-flex flex-column border border-dark">
                    <div class="d-flex col nav nav-tabs bg-light pt-2 px-2">
                        <div>
                            <a href="{{ route('all-guest-house') }}" class="nav-link active px-4 fw-bold">
                                view
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('add-guest-house') }}" class="nav-link">
                                add
                            </a>
                        </div>
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
                                                    <a href="{{ route('view-guest-house', ['id' => $guestHouse->id ]) }}" class="btn btn-sm btn-info">
                                                        View
                                                    </a>
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
