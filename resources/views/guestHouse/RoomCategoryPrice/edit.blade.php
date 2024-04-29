<!-- resources/views/profile.blade.php -->

{{-- {{ dd($roomCategories); }} --}}

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-admin.navbar/>

            <div class="page-content">
                  
                <x-page-header :title="'Edit'" :prev="'Room Category'" />
                <div class="d-flex flex-column border border-dark card">
                    <div class="nav nav-tabs bg-primary bg-opacity-25 pt-2 px-2">
                        <div>
                            <a href="{{ route('room-category') }}" class="nav-link">
                                view
                            </a>
                        </div>
                        <div>
                            <button class="nav-link active px-4 fw-bold">
                                edit
                            </button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <div class="card-body" id="categoryForm">
                            <form action="{{ route('update-room-category') }}" method="POST">
                                <div class="mb-3">
                                    <label for="categoryName" class="form-label">Room Category Name</label>
                                    <input id="categoryName" class="form-control" name="categoryName" type="text" 
                                        value="{{ $roomCategory->name }}" placeholder="Room category">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">Price Modifier</label>
                                    <input type="text" class="form-control" name="price_modifier" value="{{ $roomCatagory->price_modifier }}" placeholder="Price modifier">
                                </div>
                                <div class="d-flex pt-2">
                                    <input type="hidden" id="categoryId" value="{{ $roomCategory->id }}" name="id">
                                    <a href="{{ route('room-category') }}" class="btn btn-sm btn-outline-primary me-2">New</a>
                                    <button id="updateCategory" class="btn btn-sm btn-success" disabled>Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <!-- .join({{ route('edit-room-category', ['id' => `${roomCategory.name}` ]) }}) --> --}}
    <script>
    $(document).ready(function() {
        $("#categoryName").on('changeinput change', function() {
            $("#updateCategory").attr('disabled', false);
        })
        
    });

    </script>

<x-main-footer/>
