<!-- resources/views/guestHouse/GuestHouse/view.blade.php -->

{{-- {{ dd($admin->admin_info); }} --}}

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-admin.navbar/>

            <div class="page-content" style="background-color: #f1fcff">
                <x-page-header :title="'Admin Profile'" />
                <div class="card d-flex flex-column border">
                    <div class="bg-success p-1"></div>
                    <form action="{{ route('update-admin-profile') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-11 mx-auto row pt-3">
                            <div class="profile col-md-4 col-sm-12">
                                {{-- <div class="w-100 text-center">
                                    <img class="mx-auto" src="{{ asset('assets/images/user.png') }}" alt="" height="160">
                                </div> --}}
                                <div class="profile-pic">
                                    {{-- <h6 class="form-label pt-3 text-center fw-bolder">Profile Picture</h6> --}}
                                    <input name="profile" type="file" id="myDropify" 
                                    @if ($admin->admin_info)
                                    data-default-file="{{ asset('storage/images/' . $admin->admin_info->profile_pic)}}"    
                                    @endif/>
                                </div>
                                {{-- <input type="file" name="profile" class="form-control my-1"> --}}
                            </div>
                            <div class="col-md-8 row p-3 fs-5">
                                <div class="col-md-6 mb-3">
                                    <div class="fw-bolder mb-1 ">Name</div>
                                    <input type="text" class="form-control" name="name" value="{{ $admin->admin_name }}" placeholder="Guest house name">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="fw-bolder mb-1 ">Role</div>
                                    <input type="text" class="form-control" value="{{ $admin->roles[0]->name }}" disabled readonly>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="fw-bolder mb-1 ">Official email</div>
                                    <input type="text" class="form-control" name="email" id="email" value="{{ $admin->email }}" placeholder="Official email address">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="fw-bolder mb-1 ">Contact number</div>
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $admin->phone }}" placeholder="Official contact number">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-11 row mx-auto p-3 fs-5">
                            <div class="col-md-4 mb-3">
                                <div class="fw-bolder mb-1 ">Address</div>
                                <input type="text" class="form-control" name="address" placeholder="Address"
                                @if ($admin->admin_info)
                                    value="{{ $admin->admin_info->address }}"
                                @endif >
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="fw-bolder mb-1 ">Gender</div>
                                <select class="form-control text-capitalize" name="gender" id="gender" readonly>
                                    <option value="" selected disabled>--select--</option>
                                    @foreach ( $genders as $gender )
                                        <option value="{{ $gender->id }}"
                                        @if ($admin->admin_info && $gender->id === $admin->admin_info->gender)
                                            selected
                                        @endif    
                                        >{{ $gender->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="fw-bolder mb-1">DOB</div>
                                <input type="date" name="dob" class="form-control"
                                @if ($admin->admin_info)
                                    value="{{ $admin->admin_info->dob }}"
                                @endif
                                >
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="fw-bolder mb-1">Nationality</div>
                                <input type="text" name="nationality" class="form-control"
                                @if ($admin->admin_info)
                                    value="{{ $admin->admin_info->nationality }}"
                                @endif
                                >
                            </div>

                            {{-- <div class="col-md-4 mb-3">
                                <div class="fw-bolder mb-1 ">PIN</div> --}}
                                {{-- <input name="PIN" class="form-control" id="pin" value="{{ $guestHouse->pin }}" placeholder="PIN code"> --}}
                            {{-- </div> --}}
                        </div>
                        <hr>
                        <div class="text-end mb-3 mx-4">
                            <button class="btn btn-success">Save changes</button>
                        </div>
                    </form>
                </div>
                <x-footer/>
            </div>
        </div>
    </div>
<!-- Custom js for this page -->
<script>

    $(document).ready(function() {
        $('#thumb').on('input', function(e) {
            var file = e.target.files[0];
            var reader = new FileReader();
            reader.onload = function(e) {
                var img = $('#thumb-view');
                img.attr('src' , e.target.result);
                if (img.attr('src')) {
                    img.next('.mdi-plus').remove();
                }
            };   
            reader.readAsDataURL(file);
        });
    });

    </script>

<x-main-footer/>
