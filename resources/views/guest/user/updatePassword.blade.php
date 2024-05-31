<!-- resources/views/guestHouse/GuestHouse/view.blade.php -->

{{-- {{ dd($orders); }} --}}

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-guest.guest-navbar/>

            <div class="page-content" style="background-color: #f1fcff">
                <x-page-header :prev="'Profile'" :title="'Update Password'" />
                <div class="card d-flex flex-column border">
                    <div class="d-flex col nav nav-tabs bg-light pt-2 px-2">
                        <div>
                            <a href="{{ route('guest-profile') }}" class="text-capitalize nav-link ">
                                view
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('edit-profile') }}" class="text-capitalize nav-link ">
                                edit
                            </a>
                        </div>
                        <div>
                            <button class="text-capitalize nav-link active px-4 fw-bold">
                                update password
                            </button>
                        </div>
                    </div>
                
                    <div class="row m-0 p-3 fs-5">
                        <div class="col-md-5 mx-auto">
                            <form action="{{ route('guest-update-password') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" autocomplete="current-password" placeholder="Password">
                                </div>
                                <div class="mb-3">
                                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirmPassword" autocomplete="current-password" placeholder="Confirm Password">
                                    <div id="jsPasswordError" class="d-none alert alert-danger mt-1 mb-1 py-2">Password not matching</div>
                                </div>
                                <div class="row mb-3">
                                    <label for="captcha" class="form-label">Captcha</label>
                                    <div class="mb-2">
                                        {{-- <img class="rounded-2" src="{{ route('captcha') }}" alt="Captcha Image"> --}}
                                        <img id="captcha-image" class="rounded-3" src="{{ route('captcha') }}" alt="Captcha Image">
                                        <button type="button" id="reload" class="ms-3 btn btn-sm btn-outline-primary"><i class="me-2 icon-md" data-feather="repea"></i>reload</button>
                                    </div>
                                    <div class="col-md-8 input-group">
                                        {{-- <input type="text" class="form-control" placeholder="Captcha code">
                                        <button class="btn btn-sm btn-outline-primary"><i class="icon-md" data-feather="repeat"></i></button> --}}
                                        <input type="text" name="" id="captcha-input" class="form-control" placeholder="Type captcha here">
                                        <button class="btn btn-success" type="button" id="verifyCaptcha">verify</button>
                                    </div>
                                </div>
                                <div class="mb-4 text-end">
                                    <button type="submit" class="btn btn-success">Change</button>
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
    $(document).ready( function () {
        const loadCaptcha = () => {
            $.ajax({
                url : "{{ route('captcha') }}",
                type: "GET",
                success: function (data) {
                var file = `data:image/png;base64,${data.image}`;
                console.log(file);
                $("#captcha-image").attr('src', file);
                }
            });
        }

        loadCaptcha();

        $('#reload').on('click', function (e) {
            e.preventDefault();
            $('#verifyCaptcha').html("verify");
            $('#verifyCaptcha').removeClass('btn-outline-primary').addClass('btn-success');
            $('#verifyCaptcha').prop('disabled', false);
            $("#captcha-input").attr('disabled', false);
            loadCaptcha();
        });

        $("#verifyCaptcha").on('click', function (e) {
            e.preventDefault();
            const captcha = $("#captcha-input").val();
            $.ajax({
                url: "{{ route('verify-captcha') }}",
                type: "POST",
                data: {captcha:captcha},
                success: function (res) {
                    if (res.message === 'success') {
                        // done
                        $('#verifyCaptcha').html(`<i class="mdi mdi-check"></i>`);
                        $('#verifyCaptcha').addClass('btn-outline-primary').removeClass('btn-success');
                        $('#verifyCaptcha').prop('disabled');
                        $("#captcha-input").attr('disabled', true);
                        console.log("done");
                    } else {
                        console.log("failed");
                    }
                }
            })
        });

        
    });

    $(document).on('input', '#confirmPassword', function () {
        const password = $("#password").val();
        const confirmPassword = $(this).val();

        if (password !== confirmPassword) {
            $("#jsPasswordError").removeClass('d-none');
        } else {
            $("#jsPasswordError").addClass('d-none');
        }
    });
    </script>

<x-main-footer/>
