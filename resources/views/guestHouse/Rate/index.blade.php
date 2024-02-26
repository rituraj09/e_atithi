<!-- resources/views/guestHouse/GuestHouse/view.blade.php -->

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-navbar/>

            <div class="page-content">
                <div class="row">
					<div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <x-page-header :title="'Manage Room Rates'"/>
                                <div class="d-flex flex-column border border-dark">
                                    <div class="d-flex col nav nav-tabs bg-light pt-2 px-2">
                                        <div>
                                            <a href="{{ route('room-rates') }}" class="nav-link active px-4 fw-bold">
                                                view
                                            </a>
                                        </div>
                                        <div>
                                            <a href="{{ route('add-room-rate') }}" class="nav-link">
                                                add
                                            </a>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="dataTableExample" class="table">
                                            <thead>
                                                <tr>
                                                <th>Name</th>
                                                <th>Room Type</th>
                                                <th>Price</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                {{-- @if (!$guestHouses)
                                                    <tr>
                                                        <td colspan="4">No Data</td>
                                                    </tr>
                                                @endif
                                                @foreach ($guestHouses as $guestHouse)
                                                    <tr>
                                                        
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
                                                @endforeach --}}
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
