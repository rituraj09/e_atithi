<!-- resources/views/guestHouse/Users/add.blade.php -->

{{-- {{ dd(auth()->user()); }} --}}

<x-header/>
<body>
  <div class="main-wrapper">
    <div class="page-wrapper">
        <x-admin.navbar/>

            <div class="page-content">
                <x-page-header :title="'Manage Reservations'"/>
                    <div class="card border">
                      <div class="d-flex col nav nav-tabs bg-light pt-2 px-2">
                          <div>
                              <a href="{{ route('all-reservations') }}" class="text-capitalize nav-link">
                                  view
                              </a>
                          </div>
                          <div>
                              <button class="text-capitalize nav-link active px-4 fw-bold">
                                  add
                              </button>
                          </div>
                      </div>
                      <div class="p-3">
                        <form class="forms-sample" action="{{ route('new-sub-user') }}" method="post">
                          @csrf
                          <div class="row mb-3">
                            <label for="fullname" class="form-label col-md-4 m-auto">Guest</label>
                            <div class="col-md-8">
                              <input type="text" class="form-control" id="fullname" autocomplete="Username" name="fullname" placeholder="full name" required>
                            </div>
                            
                          </div>

                          <div class="row mb-3">
                            <label for="checkin" class="form-label col-md-4 m-auto">Checkin Date</label>
                            <div class="col-md-8">
                              <div class="input-group col-md-8 flatpickr me-2 mb-2 mb-md-0" id="dashboardDate">
                                <input type="text" class="form-control bg-transparent" name="ckeckin" placeholder="Select date" data-input>
                              </div>
                            </div>
                          </div>

                          <div class="row mb-3">
                            <label for="checkout" class="form-label col-md-4 m-auto">Checkout Date</label>
                            <div class="col-md-8">
                              <div class="input-group col-md-8 flatpickr me-2 mb-2 mb-md-0" id="dashboardDate">
                                <input type="text" class="form-control bg-transparent" name="ckeckout" placeholder="Select date" data-input>
                              </div>
                            </div>
                          </div>

                          <div class="row mb-2">
                            <label for="phone" class="form-label col-md-4 m-auto">Guest House</label>
                            <div class="col-md-8">
                              <input type="text" class="form-control" id="phone" name="phone" placeholder="+91" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
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
                    </div>
                </div>
            </div>
        </div>
    </div>

<x-main-footer/>