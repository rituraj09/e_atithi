<!-- resources/views/guestHouse/GuestHouse/view.blade.php -->

{{-- {{ dd($orders); }} --}}

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-guest.guest-navbar/>

            <div class="page-content" style="background-color: #f1fcff">
                <x-page-header :prev="'Profile'" :title="'Edit Profile'" />
                <div class="card d-flex flex-column border">
                    <div class="d-flex col nav nav-tabs bg-light pt-2 px-2">
                        <div>
                            <a href="{{ route('guest-profile') }}" class="text-capitalize nav-link ">
                                view
                            </a>
                        </div>
                        <div>
                            <button class="text-capitalize nav-link active px-4 fw-bold">
                                edit
                            </button>
                        </div>
                        <div>
                            <a href="{{ route('update-password') }}" class="text-capitalize nav-link ">
                                update password
                            </a>
                        </div>
                    </div>
                {{-- <div class="card row mb-2 p-3"> --}}
                    <form action="{{ route('update-guest-profile') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row m-0 p-3 fs-5">
                            <div class="col-md-4 mb-3">
                                <div class="fw-bolder mb-1 ">Name</div>
                                <input id="name" class="text-darkgray form-control" name="name" value="{{ $guestDetails->guest->name }}" >
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="fw-bolder mb-1 ">Email</div>
                                <input id="email" class="text-darkgray form-control" name="email" value="{{ $guestDetails->guest->email }}" >
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="fw-bolder mb-1 ">Phone</div>
                                <input id="phone" class="text-darkgray form-control" name="phone" value="{{ $guestDetails->guest->phone }}" >
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="fw-bolder mb-1 ">DOB</div>
                                <input type="date" class="text-darkgray form-control" name="dob" value="{{ $guestDetails->dob }}" >
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="fw-bolder mb-1 ">Nationality</div>
                                <input id="nationality" class="text-darkgray form-control" name="nationality" value="{{ $guestDetails->nationality }}" >
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="fw-bolder mb-1 ">Address</div>
                                <input id="address" class="text-darkgray form-control" name="address" value="{{ $guestDetails->address }}" >
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="fw-bolder mb-1 ">Gender</div>
                                <select name="gender" id="gender" class="text-drakgray form-control">
                                    <option value="null" disabled>--select--</option>
                                    @foreach ($genders as $gender)
                                        <option value="{{ $gender->id }}"
                                            @if ($gender->name === $guestDetails->gender)
                                                selected
                                            @endif
                                        >{{ $gender->name }}</option>
                                    @endforeach
          
          
                                </select>
                                {{-- <input id="reservationNo" class="text-darkgray form-control"  value="Male" > --}}
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="fw-bolder mb-1 ">Guest Type</div>
                                <select name="guest_type" class="text-darkgray form-control">
                                    <option value="" disabled>--select--</option>
                                    @foreach ($guestCategories as $guestCategory)
                                        <option value="{{ $guestCategory->id }}"
                                            @if ($guestCategory->name === $guestDetails->guestcategory_id)
                                                selected
                                            @endif
                                        >{{ $guestCategory->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="row col-md-8 mx-auto mb-3">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="profile-pic">
                                        <h6 class="form-label pt-3 text-center fw-bolder">Profile Picture</h6>
                                        <input name="profile_pic" type="file" id="myDropify"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="">
                                        <h6 class="form-label pt-3 text-center fw-bolder">Id Card</h6>
                                        <input name="id_card_file" type="file" id="myDropify2"/>
                                        <div class="my-3">
                                            <div class="fw-bolder mb-1">Card Type</div>
                                            <select name="id_card_type" id="" class="form-control text-darkgray">
                                                <option value="" selected disabled>--select--</option>
                                                @foreach ($idCardTypes as $idCardType)
                                                    <option value="{{ $idCardType->id }}"
                                                    @if ($idCardType === $guestDetails->id_card_type)
                                                        selected
                                                    @endif    
                                                    >{{ $idCardType->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-4 text-end">
                            <button class="btn btn-success" type="submit">Save changes</button>
                        </div>
                    </form>
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
