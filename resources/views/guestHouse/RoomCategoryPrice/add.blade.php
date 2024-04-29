<!-- resources/views/profile.blade.php -->

{{-- {{ dd($guest); }} --}}

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-admin.navbar/>

            <div class="page-content">
                <x-page-header :prev="'Manage Room Categories'" :title="'Add'" />
                <div class="d-flex flex-column border card">
                    <div class="nav nav-tabs bg-light pt-2 px-2">
                        <div>
                            <a href="{{ route('room-category') }}" class="text-capitalize nav-link" id="view">
                                view
                            </a>
                        </div>
                        <div>
                            <button class="text-capitalize nav-link active px-4 fw-bold" id="add">  
                                add
                            </button>
                        </div>
                    </div>
					<div class="card-body">
						<form action="{{ route('new-room-category-price') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="categoryName" class="form-label">Room Category</label>
                                <select name="category" id="" class="form-control">
                                    <option value="" selected disabled>--select--</option>
                                    @foreach ($roomCategories as $roomCategory)
                                        <option value="{{ $roomCategory->id }}">{{ $roomCategory->name }}</option>
                                    @endforeach
                                </select>
                                {{-- <input id="categoryName" class="form-control" name="categoryName" type="text" placeholder="Room category"> --}}
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Price Modifier</label>
                                <input type="text" class="form-control" name="price_modifier" placeholder="Price modifier">
                            </div>
                            <div class="d-flex justify-content-end pt-2">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <x-footer/>
        </div>
    </div>

<x-main-footer/>
