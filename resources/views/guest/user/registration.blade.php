<x-header/>
{{-- {{dd(session('otp'));}} --}}
<body>
  <x-loading/>
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
                    <form class="forms-sample" action="{{ route('new-guest-registration')}}" method="post">
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
                          <input type="text" class="form-control" id="phone" name="phone" placeholder="+91" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
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
                          <div class="input-group">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email address">
                            <button id="emailVerification" type="button" class="btn btn-sm btn-success">Verify</button>
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

  <script>
  $(document).ready(function (){
    $('#emailVerification').on('click', function (e) {
      e.preventDefault();
      const email = $('#email').val();

      Swal.fire({
        html: `
          <div class="my-2">
            <input class="form-control" type='text' id="otp" placeholder="Enter OTP">
          </div>
          <div class="row mx-0">
            <div class="col"><button class="btn btn-primary btn-sm w-100" id="verify">verify</button></div>
            <div class="col"><button class="btn btn-warning btn-sm w-100" id="resend">resend OTP</button></div>
          </div>
        `,
        showConfirmButton: false,
        allowOutsideClick: false,
      });

      $.ajax({
        url: "{{ route('email-otp') }}",
        type: "POST",
        data: {email:email},
        success: function (res) {
          console.log(res);
          Swal.fire({
            position: "top-end",
            title: "Your OTP has been sent to your email.",
            showConfirmButton: false,
            timer: 1500
          });
          $('#loading').addClass('d-none');
          Swal.fire({
            html: `
              <div class="my-2">
                <input class="form-control" type='text' id="otp" placeholder="Enter OTP">
              </div>
              <div class="row mx-0">
                <div class="col"><button class="btn btn-primary btn-sm w-100" id="verify">verify</button></div>
                <div class="col"><button class="btn btn-warning btn-sm w-100" id="resend">resend OTP</button></div>
              </div>
            `,
            showConfirmButton: false,
            allowOutsideClick: false,
          });
        }
      })
      $('#loading').removeClass('d-none');

      // $('#')
    })
  })
  </script>

<x-main-footer/>