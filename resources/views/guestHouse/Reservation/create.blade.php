<!-- resources/views/guestHouse/Users/add.blade.php -->

{{-- {{ dd(auth()->user()); }} --}}

<x-header/>
<body>
  <div class="main-wrapper">
    <div class="page-wrapper">
        <x-navbar/>

            <div class="page-content">
                <div class="row">
					          <div class="col-md-10 m-auto grid-margin stretch-card">
                        <div class="card">
                            {{-- <div class="ps-md-0"> --}}
                                <div class="card-body p-5">
                                  <h5 class="card-title mb-4">Create a sub-user.</h5>
                                  <form class="forms-sample" action="{{ route('new-sub-user') }}" method="post">
                                    @csrf
                                    <div class="row mb-3">
                                      <label for="fullname" class="form-label col-md-4 m-auto">Full name</label>
                                      <div class="col-md-8">
                                        <input type="text" class="form-control" id="fullname" autocomplete="Username" name="fullname" placeholder="full name" required>
                                      </div>
                                      
                                    </div>
                                    <div class="row mb-2">
                                      <label for="phone" class="form-label col-md-4 m-auto">Phone no.</label>
                                      <div class="col-md-8">
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="+91" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
                                      </div>
                                      
                                    </div>
                                    <div class="row mb-3">
                                      <label for="phone-otp" class="form-label col-md-4 m-auto">OTP for phone</label>
                                      <div class="col-md-8">
                                        <div class="input-group">
                                          <input type="text" id="phone-otp" class="form-control" placeholder="OTP sent to phone number">
                                          <button class="btn btn-success">verify</button>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row mb-2">
                                      <label for="email" class="form-label col-md-4 m-auto">Email address</label>
                                      <div class="col-md-8">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email address" required>
                                      </div>
                                      
                                    </div>
                                    <div class="row mb-3">
                                      <label for="email-otp" class="form-label col-md-4 m-auto">OTP for email</label>
                                      <div class="col-md-8">
                                        <div class="input-group">
                                          <input type="text" id="email-otp" class="form-control" placeholder="OTP sent to email address"/>
                                          <button type="button" class="btn btn-success">verify</button>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row mb-2">
                                      <label for="captcha" class="form-label col-md-4 m-auto">Captcha</label>
                                      <div class="col-md-8">
                                          <img class="rounded-3" src="{{ route('captcha') }}" alt="Captcha Image">
                                          <button class="ms-3 btn btn-sm btn-outline-primary"><i class="me-2 icon-md" data-feather="repeat"></i>reload</button>
                                      </div>
                                    </div>
                                    <div class="row mb-3">
                                      <div class="col-md-4"></div>
                                      <div class="col-md-8">
                                        <div class="input-group">
                                          <input type="text" name="captcha" id="" class="form-control" placeholder="Type captcha here" required>
                                          <button class="btn btn-success">verify</button>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row mb-3">
                                      <label for="role" class="form-label col-md-4 m-auto">User/Employee type</label>
                                      <div class="col-md-8">
                                          <select name="role" id="role" class="form-control" required>
                                              <option value="" selected disabled>--select--</option>
                                              @foreach ($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name}}</option>
                                              @endforeach
                                          </select>
                                      </div>
                                    </div>
                                    @if (auth()->user()->roles[0]->name === 'super admin')
                                    <div class="row mb-3">
                                      <label for="role" class="form-label col-md-4 m-auto">Guest House</label>
                                      <div class="col-md-8">
                                          <select name="guestHouse" id="guestHouse" class="form-control" required>
                                              <option value="" selected disabled>--select--</option>
                                              @foreach ($guestHouses as $guestHouse)
                                                <option value="{{ $guestHouse->id }}">
                                                  {{ $guestHouse->name}} || {{ $guestHouse->district_name->name }}, {{ $guestHouse->state_name->name }}, {{ $guestHouse->country_name->name }}
                                              </option>
                                              @endforeach
                                          </select>
                                      </div>
                                    </div>
                                    @endif
                                    <div class="row mb-3">
                                      <label for="userPassword" class="form-label col-md-4 m-auto">Password</label>
                                      <div class="col-md-8">
                                          <div class="input-group">
                                              <input type="password" class="form-control" id="userPassword" name="password" autocomplete="current-password" placeholder="Password" required>
                                              <button class="btn btn-success">generate</button>
                                          </div>
                                        </div>
                                    </div>
                                    <div>
                                      <button type="submit" class="btn btn-primary text-white me-2 mb-2 mb-md-0">Register</button>
                                    </div>
                                  </form>
                                </div>
                              {{-- </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<x-main-footer/>