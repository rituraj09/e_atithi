{{-- @php
    phpinfo(INFO_MODULES);
@endphp --}}

{{-- 
<form action="{{ route('guest-registration')}}" method="post">
    @csrf
    <div>
        <label for="fullname">Full Name</label>
        <input type="text" name="fullname" id="fullname">
    </div>
    <div>
        <label for="phone">Phone</label>
        <input type="number" name="phone" id="phone">
    </div>
    <div>
        <label for="phoneOtp">OTP</label>
        <input type="number" name="phoneOtp" id="phoneOtp">
        <button>verify</button>
    </div>
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
    </div>
    <div>
        <label for="emailOtp">OTP</label>
        <input type="number" name="emailOtp" id="emailOtp">
        <button>verify</button>
    </div>
    <div>
        <img src="{{ route('captcha') }}" alt="Captcha Image">
        <button>reload</button>
    </div>
    <div>
        <input type="text" name="captcha" id="captcha">
        <button>verify</button>
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
    </div>
    <div>
        <label for="confirmPassword">Confirm Password</label>
        <input type="password" name="confirmPassword" id="confirmPassword">
    </div>
    <div>
        <input type="submit" value="Register">
    </div>
</form> --}}

<x-header/>

<body>
	<div class="main-wrapper">
		<div class="page-wrapper full-page">
			<div class="page-content d-flex align-items-center justify-content-center">

				<div class="row w-100 mx-0 auth-page">
					<div class="col-md-10 col-xl-8 mx-auto">
						<div class="card">
							<div class="row">
                <div class="col-md-4 pe-md-0">
                  <div class="auth-side-wrapper">

                  </div>
                </div>
                <div class="col-md-8 ps-md-0">
                  <div class="auth-form-wrapper p-5">
                    <a href="#" class="noble-ui-logo logo-light d-block mb-2"><span>e</span>Atithi</a>
                    <h5 class="text-muted fw-normal mb-4">Create a free account.</h5>
                    <form class="forms-sample" action="{{ route('guest-registration')}}" method="post">
                        @csrf
                      <div class="row mb-3">
                        <label for="fullname" class="form-label col-md-4 m-auto">Full name</label>
                        <div class="col-md-8">
                          <input type="text" class="form-control" id="fullname" autocomplete="Username" name="fullname" placeholder="full name">
                        </div>
                        
                      </div>
                      <div class="row mb-2">
                        <label for="phone" class="form-label col-md-4 m-auto">Phone no.</label>
                        <div class="col-md-8">
                          <input type="number" class="form-control" id="phone" name="phone" placeholder="+91">
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
                          <input type="email" class="form-control" id="email" name="email" placeholder="Email address">
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
                        {{-- <input type="email" class="form-control" id="userEmail" placeholder="Email"> --}}
                      </div>
                      <div class="row mb-3">
                        <div class="col-md-4"></div>
                        <div class="col-md-8">
                          <div class="input-group">
                            <input type="text" name="" id="" class="form-control" placeholder="Type captcha here">
                            <button class="btn btn-success">verify</button>
                          </div>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="userPassword" class="form-label col-md-4 m-auto">Password</label>
                        <div class="col-md-8">
                          <input type="password" class="form-control" id="userPassword" name="password" autocomplete="current-password" placeholder="Password">
                        </div>
                        
                      </div>
                      <div class="row mb-3">
                        <label for="confirmPassword" class="form-label col-md-4 m-auto">Confirm Password</label>
                        <div class="col-md-8">
                          <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" autocomplete="current-password" placeholder="Confirm password">
                        </div>
                      </div>
                      <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="authCheck">
                        <label class="form-check-label" for="authCheck">
                          Remember me
                        </label>
                      </div>
                      <div>
                        <input type="submit" class="btn btn-primary text-white me-2 mb-2 mb-md-0" value="Register" />
                      </div>
                      <a href="{{ route('guest-login')}}" class="d-block mt-3 text-muted">Already a user? Sign in</a>
                    </form>
                  </div>
                </div>
              </div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

	<!-- core:js -->
	<script src="../../../assets/vendors/core/core.js"></script>
	<!-- endinject -->

	<!-- Plugin js for this page -->
	<!-- End plugin js for this page -->

	<!-- inject:js -->
	<script src="../../../assets/vendors/feather-icons/feather.min.js"></script>
	<script src="../../../assets/js/template.js"></script>
	<!-- endinject -->

	<!-- Custom js for this page -->
  <script type="text/javascript" src="{{ asset('js/maxLength.js')}}"></script>
	<!-- End custom js for this page -->

</body>
</html>