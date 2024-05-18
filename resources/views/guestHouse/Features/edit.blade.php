<!-- resources/views/profile.blade.php -->

{{-- {{ dd($roomCategories ); }} --}}

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-admin.navbar/>

            <div class="page-content">
                <x-page-header :prev="'Manage Features'" :title="'Add'"/>
                <div class="d-flex flex-column border card">
                    <div class="d-flex col nav nav-tabs bg-light pt-2 px-2">
                        <div>
                            <a href="{{ route('guest-house-room-features') }}" class="text-capitalize nav-link">
                                view
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('add-guest-house-room-features') }}" class="text-capitalize nav-link">
                                Add
                            </a>
                        </div>
                        <div>
                            <button class="text-capitalize nav-link active px-4 fw-bold">
                                edit
                            </button>
                        </div>
                    </div>
                    <div class="pt-3">
                        <form id="newRoomForm" action="{{ route('update-room-feature') }}" method="POST" class="mx-3 mx-md-3" >
                            @csrf
                            <div class="d-block py-2" >
                                <div class="col-md-8 mx-auto">
                                    <input type="hidden" name="id" value="{{ $feature->id }}">
                                    <div class="mb-3">
                                        <label for="fname" class="form-label">Feature's name <x-required/> </label>
                                        <input type="text" id="fname" class="form-control" name="name" value="{{ $feature->name }}" placeholder="Feature's name">
                                        @error('name')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea name="description" id="description" cols="30" rows="3" class="form-control">{{ $feature->description }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Price <x-required/> </label>
                                        <input type="text" class="form-control" id="price" name="price" value="{{ $feature->price }}" placeholder="Price modifier">
                                        @error('price')
                                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="remarks" class="form-label">Remarks</label>
                                        <textarea name="remarks" id="remarks" cols="30" rows="3" class="form-control">{{ $feature->remarks }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-5 col-md-4 mx-auto">
                                <button class="btn btn-success w-100">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>

    </script>

<x-main-footer/>