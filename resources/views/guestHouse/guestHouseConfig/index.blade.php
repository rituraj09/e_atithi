<!-- resources/views/guestHouse/GuestHouse/view.blade.php -->

{{-- {{ dd($guestHouse->pin); }} --}}

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-admin.navbar/>

            <div class="page-content" style="background-color: #f1fcff">
                <x-page-header :title="'Config Page'" />
                <div class="card d-flex flex-column border">
                    <div class="bg-success p-1"></div>
                    <form action="{{ route('update-guest-house-config') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="guestHouse_id" value="{{ $guestHouse->id }}">
                        <div class="col-md-11 row mx-auto p-3 fs-5">
                            <div class="col-md-4 mb-3">
                                <div class="fw-bolder mb-1 ">Name</div>
                                <input type="text" class="form-control" name="name" value="{{ $guestHouse->name }}" placeholder="Guest house name">
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="fw-bolder mb-1 ">Official email</div>
                                <input type="text" class="form-control" name="email" id="email" value="{{ $guestHouse->official_email }}" placeholder="Official email address">
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="fw-bolder mb-1 ">Contact number</div>
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ $guestHouse->contact_no }}" placeholder="Official contact number">
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-11 row mx-auto p-3 fs-5">
                            <div class="col-md-4 mb-3">
                                <div class="fw-bolder mb-1 ">Address</div>
                                <input type="text" class="form-control" name="address" placeholder="Address">
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="fw-bolder mb-1 ">Country</div>
                                <select class="form-control" name="country" id="country">
                                    @foreach ( $countries as $country )
                                        <option value="{{ $country->id }}"
                                        @if ($country->id === $guestHouse->country)
                                            selected
                                        @endif    
                                        >{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="fw-bolder mb-1 ">State</div>
                                <select class="form-control" name="state" id="state">
                                    @foreach ( $states as $state )
                                        <option value="{{ $state->id }}"
                                        @if ($state->id === $guestHouse->state)
                                            selected
                                        @endif    
                                        >{{ $state->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
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
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="fw-bolder mb-1 ">PIN</div>
                                <input name="PIN" class="form-control" value="{{ $guestHouse->pin }}" placeholder="PIN code">
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-11 row mx-auto p-3 fs-5">
                            <div class="col-md-4 mb-3">
                                <div class="fw-bolder mb-1 ">Guest type</div>
                                <select name="guest_type" id="" class="form-control text-capitalize">
                                    <option value="1"
                                    @if ($guestHouse->guest_type === 1)
                                        selected
                                    @endif
                                    >Govt employee</option>
                                    <option value="0"
                                    @if ($guestHouse->guest_type === 0)
                                        selected
                                    @endif
                                    >All ( Govt and General public )</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="fw-bolder mb-1 ">Payment type</div>
                                <select name="payment_type" id="" class="form-control">
                                    <option value="1"
                                    @if ($guestHouse->payment_type === 1)
                                        selected
                                    @endif
                                    >Postpaid</option>
                                    <option value="0"
                                    @if ($guestHouse->payment_type === 0)
                                        selected
                                    @endif
                                    >Prepaid</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="fw-bolder mb-1">Base price</div>
                                <input type="text" id="price" name="base_price" class="form-control" value="{{ $guestHouse->base_price }}" placeholder="Per room base price">
                            </div>
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


<x-main-footer/>
