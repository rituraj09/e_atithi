<!-- resources/views/guestHouse/GuestHouse/view.blade.php -->

{{-- {{ dd($genders); }} --}}

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-admin.navbar/>

            <div class="page-content" style="background-color: #f1fcff">
                <x-page-header :title="'Admin Profile'" />
                <div class="card d-flex flex-column border">
                    <div class="bg-success p-1"></div>
                    <form action="{{ route('update-guest-house-config') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-11 row mx-auto p-3 fs-5">
                            <div class="col-md-4 mb-3">
                                <div class="fw-bolder mb-1 ">Name</div>
                                <input type="text" class="form-control" name="name" value="{{ $admin->admin_name }}" placeholder="Guest house name">
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="fw-bolder mb-1 ">Official email</div>
                                <input type="text" class="form-control" name="email" id="email" value="{{ $admin->email }}" placeholder="Official email address">
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="fw-bolder mb-1 ">Contact number</div>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ $admin->phone }}" placeholder="Official contact number">
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-11 row mx-auto p-3 fs-5">
                            <div class="col-md-4 mb-3">
                                <div class="fw-bolder mb-1 ">Address</div>
                                <input type="text" class="form-control" name="address" placeholder="Address">
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="fw-bolder mb-1 ">Gender</div>
                                <select class="form-control" name="gender" id="gender" readonly>
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
                                <div class="fw-bolder mb-1 ">Role</div>
                                <input type="text" class="form-control" value="{{ $admin->roles[0]->name }}" disabled readonly>
                            </div>
                            {{-- <div class="col-md-4 mb-3">
                                <div class="fw-bolder mb-1 ">Country</div>
                                <select class="form-control" name="country" id="country">
                                    @foreach ( $countries as $country )
                                        <option value="{{ $country->id }}"
                                        @if ($country->id === $admin->admin_info)
                                            selected
                                        @endif    
                                        >{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                            {{-- <div class="col-md-4 mb-3">
                                <div class="fw-bolder mb-1 ">State</div>
                                <select class="form-control" name="state" id="state">
                                    @foreach ( $genders as $gender )
                                        <option value="{{ $gender->id }}"
                                        @if ($gender->id === $guestHouse->state)
                                            selected
                                        @endif    
                                        >{{ $gender->name }}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                            {{-- <div class="col-md-4 mb-3">
                                <div class="fw-bolder mb-1 ">District</div>
                                <select class="form-control" name="district" id="district">
                                    @foreach ( $districts as $district )
                                        <option value="{{ $district->id }}"
                                        @if ($district->id === $guestHouse->district)
                                            selected
                                        @endif    
                                        >{{ $district->name }}</option>
                                    @endforeach
                                </select>
                            </div> --}}
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
