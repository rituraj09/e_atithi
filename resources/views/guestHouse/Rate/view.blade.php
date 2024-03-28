<!-- resources/views/guestHouse/Rate/view.blade.php -->

{{-- {{ dd($roomRate); }} --}}

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-admin.navbar/>

            <div class="page-content">
                <x-page-header :prev="'Manage Room Rates'" :title="'view'"/>
                <div class="d-flex flex-column border card">
                    <div class="d-flex col nav nav-tabs bg-light pt-2 px-2">
                        <div>
                            <a href="{{ route('room-rates') }}" class="text-capitalize nav-link">
                                View
                            </a>
                        </div>
                        <div>
                            <button id="roomButton" class="text-capitalize nav-link active px-4 fw-bold">
                                Details
                            </button>
                        </div> 
                    </div>
                    <div class="pt-3" id="roomView">
                        <form id="newRoomForm" class="mx-2 mx-md-3" action="{{ route('guest-house-new-room') }}" method="POST">
                            @csrf
                            <div class="row m-0 p-0">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input id="name" class="form-control text-capitalize" name="name" value="{{ $roomRate->name }}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Rate</label>
                                        <input id="price" class="form-control" name="price" type="text" value="{{ $roomRate->price }}"
                                            onkeypress="return event.charCode >= 48 && event.charCode <= 57" readonly>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="roomCategory" class="form-label">Room Category</label>
                                        <select class="form-control" readOnly name="roomCategory" id="roomCategory" required>
                                            <option value="" disabled>--select--</option>
                                            @foreach ( $roomCategories as $roomCategory )
                                                <option value="{{ $roomCategory->id }}" 
                                                @if ( $roomCategory->id === $roomRate->room_category )
                                                    selected
                                                @endif    
                                                >{{ $roomCategory->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end py-3 px-3">
                                <button id="formSubmit" class="btn btn-success mx-auto">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <x-footer/>
        </div>
    </div>

<x-main-footer/>
