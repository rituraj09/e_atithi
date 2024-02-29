<!-- resources/views/profile.blade.php -->

{{-- {{ dd($guest); }} --}}

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-navbar/>

            <div class="page-content">
                <x-page-header :title="'Manage Users'"/>
                <div class="d-flex flex-column border card">
                    <div class="d-flex col nav nav-tabs bg-light pt-2 px-2">
                        <div>
                            <a href="{{ route('all-sub-users') }}" class="nav-link active px-4 fw-bold">
                                view
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('add-sub-users') }}" class="nav-link">
                                add
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                <th>Name</th>
                                <th>Role Type</th>
                                <th>Contacts</th>
                                <th>Guest House</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="userList">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Custom js for this page -->
    <!-- End custom js for this page -->
    <script>
    $(document).ready( function () {
        function reload () {
            var path = "{{ route('get-all-sub-users') }}"
            $.ajax({
                url: path,
                type: 'GET',
                success: function(res) {
                    console.log(res);
                    const html = res.map(data => `
                        <tr>
                            <td>${data.admin_name}</td>
                            <td>${data.roles[0].name || data.role}</td>
                            <td>${data.phone}</td>
                            <td>${data.email}</td>
                            <td>
                                <div class="d-flex py-0">
                                    <div class="px-1">
                                        <button class="btn btn-danger btn-sm py-1 delete-btn" data-id="${data.id}">
                                            Delete
                                        </button>
                                    </div>
                                    <div class="px-1">
                                        <button class="btn btn-primary btn-sm py-1 edit-btn" data-id="${data.id}">
                                            Edit
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>    
                    `).join('');
                    $("#userList").html(html);
                }
            })
        }

        reload();
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
        const editRoute = "{{ route('edit-sub-user', ':id') }}"; // Replace with your actual route
        window.location.href = editRoute.replace(':id', id);
    });
    </script>

<x-main-footer/>
