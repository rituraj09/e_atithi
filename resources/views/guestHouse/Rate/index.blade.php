<!-- resources/views/guestHouse/GuestHouse/view.blade.php -->

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-navbar/>

            <div class="page-content">
                <x-page-header :title="'Manage Room Rates'" />
                <div class="d-flex flex-column border card">
                    <div class="nav nav-tabs tab-wrapper">
                        <div>
                            <a href="{{ route('room-rates') }}" class="text-capitalize nav-link active px-4 fw-bold">
                                view
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('add-room-rate') }}" class="text-capitalize nav-link">
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
                                @foreach ($roomRates as $roomRate)
                                    <tr>
                                        <td>{{ $roomRate['name'] }}</td>
                                        <td>{{ $roomRate['roomCategory']->name }}</td>
                                        <td>{{ $roomRate['price'] }}</td>
                                        <td>
                                            <div class="form-check form-switch px-auto me-0">
                                                <input type="checkbox" class="form-check-input rate-status" id="formSwitch1" data-id="{{ $roomRate->id }}"
                                                @if ( $roomRate['is_active'])
                                                    checked
                                                @endif>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="" class="btn btn-sm btn-info me-2">view</a>
                                                <a href="{{ route('edit-room-rate', ['id' => $roomRate->id]) }}" class="btn btn-sm btn-primary me-2">edit</a>
                                                {{-- @if ($roomRate->)
                                                    
                                                @endif --}}
                                                <button class="btn btn-sm btn-danger me-2 ask-delete" data-id="{{ $roomRate->id }}">delete</button>
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
    $(document).on('change', '.rate-status', function () {
        console.log('check')
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var id = $(this).data('id');
        Swal.fire({
            title: "Do you want to change the status?",
            text: "You won't be able to revert !" + id,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, change it!"
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "#",
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
            } else {
                // $(this). reload
                Swal.fire("Status not changed", "", "info");
            }
        });

    })
    $(document).ready( function () {
        // common csrf header
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        const deleteUrl = "{{ route('delete-room-rate')}}";
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
                        text: "Rate is deleted successfully",
                        icon: "success"
                    });
                }
            });
        });
    })
    </script>

<x-main-footer/>
