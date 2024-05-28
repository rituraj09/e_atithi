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
                            <table class="table" id="example">
                                <thead>
                                    <tr>
                                        <th>Room Category</th>
                                        <th>Price Modifier</th>
                                        <th>Features</th>
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
                                                @foreach ($features as $feature)
                                                    @if ( $feature->room_category_id === $roomCategory->id && $feature->is_active )
                                                        <span class="bg-primary text-white p-1 px-2 rounded mx-1">
                                                            {{ $feature->featureDetails->name }}
                                                        </span>
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                <div class="d-flex py-0">
                                                    <div class="px-1">
                                                        <button class="btn btn-danger btn-sm py-1 delete-btn" data-id="{{ $roomCategory->id }}">
                                                            delete
                                                        </button>
                                                    </div>
                                                    <div class="px-1">
                                                        <button class="open-popup btn btn-success py-1 btn-sm" data-href="{{ route('room-has-features', ['id' => $roomCategory->id]) }}">Features</button>
                                                    </div>
                                                    <div class="px-1">
                                                        <button data-href="{{ route('edit-room-category-price', ['id' => $roomCategory->id ]) }}" class="btn btn-primary btn-sm py-1 open-popup">
                                                            edit
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <x-popup/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <!-- .join({{ route('edit-room-category', ['id' => `${roomCategory.name}` ]) }}) --> --}}
    <script>


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

    </script>

<x-main-footer/>
