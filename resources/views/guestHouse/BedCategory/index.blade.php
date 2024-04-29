<!-- resources/views/guestHouse/GuestHouse/view.blade.php -->

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-admin.navbar/>

            <div class="page-content">
                <x-page-header :title="'Manage Bed Categories'" />
                <div class="d-flex flex-column border card">
                    <div class="nav nav-tabs tab-wrapper">
                        <div>
                            <a href="{{ route('bed-categories') }}" class="text-capitalize nav-link active px-4 fw-bold">
                                view
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('add-bed-category') }}" class="text-capitalize nav-link">
                                add
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                <th>Name</th>
                                <th>Capacity</th>
                                <th>Price Modifier</th>
                                <th>Remark</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bedCategories as $bedCategory)
                                    <tr>
                                        <td>{{ $bedCategory['Bed']->name }}</td>
                                        <td>{{ $bedCategory['Bed']->capacity }}</td>
                                        <td>{{ $bedCategory['price_modifier'] }}</td>
                                        <td>{{ $bedCategory['remarks'] }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('view-bed-category', ['id' => $bedCategory->id]) }}" class="btn btn-sm btn-info me-2">view</a>
                                                <a href="{{ route('edit-bed-category', ['id' => $bedCategory->id]) }}" class="btn btn-sm btn-primary me-2">edit</a>
                                                <button class="btn btn-sm btn-danger me-2 ask-delete" data-id="{{ $bedCategory->id }}">delete</button>
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
