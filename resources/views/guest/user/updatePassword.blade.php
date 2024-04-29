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
                            <a href="{{ route('guest-profile') }}" class="text-capitalize nav-link ">
                                view
                            </a>
                        </div>
                        <div>
                            <button class="text-capitalize nav-link ">
                                edit
                            </button>
                        </div>
                        <div>
                            <button class="text-capitalize nav-link active px-4 fw-bold">
                                update password
                            </button>
                        </div>
                    </div>
                
                    <div class="row m-0 p-3 fs-5">
                        <div class="col-md-8 mx-auto">
                            <form action="">
                                @csrf
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" autocomplete="current-password" placeholder="Password">
                                </div>
                                <div class="mb-3">
                                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirmPassword" autocomplete="current-password" placeholder="Confirm Password">
                                </div>
                                <div class="row mb-3">
                                    <label for="captcha" class="form-label">Captcha</label>
                                    <div class="mb-2">
                                        <img class="rounded-2" src="{{ route('captcha') }}" alt="Captcha Image">
                                    </div>
                                    <div class="col-md-8 input-group">
                                        <input type="text" class="form-control" placeholder="Captcha code">
                                        <button class="btn btn-sm btn-outline-primary"><i class="icon-md" data-feather="repeat"></i></button>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <button class="btn btn-success">Change</button>
                                </div>
                            </form>
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
