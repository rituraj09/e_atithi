<!-- resources/views/guestHouse/GuestHouse/view.blade.php -->

{{-- {{ dd($orders); }} --}}

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
                            <a href="{{ route('edit-profile') }}" class="text-capitalize nav-link ">
                                edit
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('update-password') }}" class="text-capitalize nav-link ">
                                update password
                            </a>
                        </div>
                    </div>
                {{-- <div class="card row mb-2 p-3"> --}}
                    
                    <div class="row m-0 p-3 fs-5">
                        <div class="col-md-4 mb-3">
                            <div class="fw-bolder mb-1 ">Name</div>
                            <input id="reservationNo" class="text-darkgray border-0" value="Abc Abck" readonly disabled>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="fw-bolder mb-1 ">Email</div>
                            <input id="reservationNo" class="text-darkgray border-0" value="user@email" readonly disabled>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="fw-bolder mb-1 ">Phone</div>
                            <input id="reservationNo" class="text-darkgray border-0" value="9876543210" readonly disabled>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="fw-bolder mb-1 ">Nationality</div>
                            <input id="reservationNo" class="text-darkgray border-0" value="Indian" readonly disabled>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="fw-bolder mb-1 ">Address</div>
                            <input id="reservationNo" class="text-darkgray border-0" value="Golaghat, Assam" readonly disabled>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="fw-bolder mb-1 ">Gender</div>
                            <input id="reservationNo" class="text-darkgray border-0" value="Male" readonly disabled>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="fw-bolder mb-1 ">User Typr</div>
                            <input id="reservationNo" class="text-darkgray border-0" value="Govt employee" readonly disabled>
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
