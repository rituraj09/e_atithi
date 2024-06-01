<!-- resources/views/guestHouse/GuestHouse/view.blade.php -->

{{-- {{ dd($guestDetail); }} --}}

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-guest.guest-navbar/>

            <div class="page-content" style="background-color: #f1fcff">
                <x-page-header :title="'Profile'" />
                <div class="card d-flex flex-column border">
                    <div class="d-flex col nav nav-tabs bg-light pt-2 px-2">
                        <div>
                            <button class="text-capitalize nav-link active px-4 fw-bold">
                                view
                            </button>
                        </div>
                        <div>
                            <a href="{{ route('edit-profile', ['id' => $guest->id]) }}" class="text-capitalize nav-link ">
                                edit
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('edit-password') }}" class="text-capitalize nav-link ">
                                update password
                            </a>
                        </div>
                    </div>
                {{-- <div class="card row mb-2 p-3"> --}}
                    
                    <div class="row m-0 p-3 fs-5">
                        <div class="col-md-4 mb-3">
                            <div class="fw-bolder mb-1 ">Name</div>
                            <input id="reservationNo" class="text-darkgray border-0" value="{{ $guest->name }}" readonly disabled>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="fw-bolder mb-1 ">Email</div>
                            <input id="reservationNo" class="text-darkgray border-0" value="{{ $guest->email }}" readonly disabled>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="fw-bolder mb-1 ">Phone</div>
                            <input id="reservationNo" class="text-darkgray border-0" value="{{ $guest->phone }}" readonly disabled>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="fw-bolder mb-1 ">Nationality</div>
                            <input id="reservationNo" class="text-darkgray border-0" value="{{ $guestDetail->nationality }}" readonly disabled>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="fw-bolder mb-1 ">Address</div>
                            <input id="reservationNo" class="text-darkgray border-0" value="{{ $guestDetail->address }}" readonly disabled>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="fw-bolder mb-1 ">Gender</div>
                            <input id="reservationNo" class="text-darkgray border-0" value="Male" readonly disabled>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="fw-bolder mb-1 ">User Type</div>
                            <input id="reservationNo" class="text-darkgray border-0 text-capitalize" value="{{ $guestDetail->guestCategory->name }}" readonly disabled>
                        </div>
                    </div>
                    <div class="row col-md-8 mx-auto mb-3 border-top">
                        <div class="col-md-6 p-4">
                            <img class="rounded border w-100" src="{{ asset('storage/images/'.$guestDetail->profile_pic) }}" alt="">    
                            <p>Profile Picture</p>
                        </div>
                        <div class="col-md-6 p-4">
                            <img class="rounded border w-100" src="{{ asset('storage/images/'.$guestDetail->id_card_file) }}" alt="">    
                            <p>Id Card</p>
                        </div>
                    </div>
                </div>
                <x-footer/>
            </div>
        </div>
    </div>

    <!-- Custom js for this page -->
    <script>
    $(document).ready(function () {

    });
    </script>

<x-main-footer/>
