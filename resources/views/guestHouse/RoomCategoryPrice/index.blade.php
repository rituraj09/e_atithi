<!-- resources/views/profile.blade.php -->

{{-- {{ dd($roomCategories); }} --}}

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-admin.navbar/>

            <div class="page-content">
                <x-page-header :title="'Manage Room Categories'" />
                <div class="d-flex flex-column border card">
                    <div class="nav nav-tabs bg-light pt-2 px-2">
                        <div>
                            <button class="text-capitalize nav-link active px-4 fw-bold">
                                view
                            </button>
                        </div>
                        <div>
                            <a href="{{ route('add-room-category-price') }}" class="text-capitalize nav-link">  
                                add
                            </a>
                        </div>
                    </div>
                    <div>
                        <div class="table-responsive category">
                            <table class="table" id="dataTableExample">
                                <thead>
                                    <tr>
                                        <th>Room Category</th>
                                        <th>Owned by</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    {{-- id="categoryList"> --}}
                                    @foreach ($roomCategories as $roomCategory)
                                        <tr>
                                            <td>{{ $roomCategory->Category->name }}</td>
                                            <td>{{ $roomCategory->price_modifier }}</td>
                                            <td>
                                                <div class="d-flex py-0">
                                                    <div class="px-1">
                                                        <button class="btn btn-danger btn-sm py-1 delete-btn" data-id="{{ $roomCategory->id }}">
                                                            delete
                                                        </button>
                                                    </div>
                                                    <div class="px-1">
                                                        <button data-id="{{ $roomCategory->id }}" class="btn btn-primary btn-sm py-1 edit-btn">
                                                            edit
                                                        </button>
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

                    const html = res.data.map(data => `
                        <tr>
                            <td>${data.name}</td>
                            <td>${data.price_modifier}</td>
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

                    // res.data.map(data => {
                    //     var rooms = data.rooms.map(room => `
                    //     <div class="px-1">
                    //         <small class="badge bg-success">
                    //             ${room.name}
                    //         </small>
                    //     </div>
                    //     `).join('');
                    //     $(`#${data.id}rooms`).html(rooms);
                    // })
                    
                }
            });
        }

        loadCategory();


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

<x-main-footer/>
