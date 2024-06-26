<!-- resources/views/guestHouse/Rate/add.blade.php -->

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-admin.navbar/>

            <div class="page-content">
                <x-page-header :prev="'Manage Bed Categories'" title="Add"/>
                <div class="d-flex flex-column border card">
                    <div class="d-flex col nav nav-tabs bg-light pt-2 px-2">
                        <div>
                            <a href="{{ route('bed-categories') }}" class="text-capitalize nav-link">
                                view
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('add-bed-category') }}" class="text-capitalize nav-link active px-4 fw-bold">
                                add
                            </a>
                        </div>
                    </div>
                    <div class="pt-3">
                        <form class="mx-2 mx-md-3 form" action="{{ route('store-bed-category') }}" method="POST">
                            @csrf
                            <div class="row m-0 p-0">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="bedType" class="form-label">Bed Category <x-required/> </label>
                                        <select name="bedType" id="bedType" class="form-control">
                                            <option value="" selected disabled>--select--</option>
                                            @foreach ($bedCategories as $bedCategory)
                                                <option value="{{ $bedCategory->id }}">{{ $bedCategory->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Price Modifier <x-required/> </label>
                                        <input id="price" class="form-control" name="price_modifier" type="text" placeholder="Price modifier" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    {{-- <div class="mb-3"> --}}
                                        <label for="price" class="form-label">Remarks</label>
                                        <textarea class="form-control" name="remarks" id="" cols="30" rows="1"></textarea>
                                    {{-- </div> --}}
                                </div>
                            </div>
                            <div class="d-flex justify-content-end py-3">
                                <button id="formSubmit" type="submit" class="btn btn-success">Submit</button>
                            </div>
                            <div class="mb-3">
                                <small class="text-danger"><span class="mdi mdi-alert fs-4 pe-1"></span>If there's no extra fee, please enter 0.</small>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


<x-main-footer/>