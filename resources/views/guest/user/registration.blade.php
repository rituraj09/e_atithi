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
                          <input type="text" class="form-control" id="fullname" autocomplete="Username" name="fullname" placeholder="Full name" required>
                          @error('phone')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                          @enderror
                        </div>
                        
                      </div>
                      <div class="row mb-3">
                        <label for="phone" class="form-label col-md-4 m-auto">Phone no.</label>
                        <div class="col-md-8">
                          <div class="input-group">
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="+91" 
                              onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
                            <button type="button" class="btn btn-sm btn-success" id="phoneVerification">verify</button>
                            <input type="hidden" name="phoneOtpStatus" id="phoneOtpStatus" required>
                          </div>
                          @error('phone')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                          @enderror 
                        </div>
                        
                      </div>
                      <div class="row mb-3">
                        <label for="email" class="form-label col-md-4 m-auto">Email address</label>
                        <div class="col-md-8">
                          <div class="input-group">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email address">
                            <button id="emailVerification" type="button" class="btn btn-sm btn-success">Verify</button>
                            <input type="hidden" name="emailOtpStatus" id="emailOtpStatus" required>
                          </div>
                          @error('email')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>
                      <div class="row mb-2">
                        <label for="captcha" class="form-label col-md-4 m-auto">Captcha</label>
                        <div class="col-md-8">
                            <img class="rounded-3" src="{{ route('captcha') }}" alt="Captcha Image">
                            <button class="ms-3 btn btn-sm btn-outline-primary"><i class="me-2 icon-md" data-feather="repea"></i>reload</button>
                        </div>
                        {{-- <input type="email" class="form-control" id="userEmail" placeholder="Email"> --}}
                      </div>
                      <div class="row mb-3">
                        <div class="col-md-4"></div>
                        <div class="col-md-8">
                          <div class="input-group">
                            <input type="text" name="" id="" class="form-control" placeholder="Type captcha here">
                            <button class="btn btn-success" type="button">verify</button>
                          </div>
                          @error('captcha')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="userPassword" class="form-label col-md-4 m-auto">Password</label>
                        <div class="col-md-8">
                          <input type="password" class="form-control" id="userPassword" name="password" autocomplete="current-password" placeholder="Password">
                          @error('password')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                          @enderror
                        </div>
                        
                      </div>
                      <div class="row mb-3">
                        <label for="confirmPassword" class="form-label col-md-4 m-auto">Confirm Password</label>
                        <div class="col-md-8">
                          <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" autocomplete="current-password" placeholder="Confirm password">
                          @error('confirmPassword')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>
                      <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="authCheck">
                        <label class="form-check-label" for="authCheck">
                          Remember me
                        </label>
                      </div>
                      <div>
                        <input type="submit" class="btn btn-primary text-white me-2 mb-2 mb-md-0" id="register" value="Register" />
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
    // CSRF header
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Phone verification using OTP
    $('#phoneVerification').on('click', function (e) {
      e.preventDefault();
      const phone = $('#phone').val();
      if (phone.length !== 10 ) {
        $(this).addClass("error");
        $(this).siblings(".error-message").remove();
        // Add error message next to the input field
        $(this).after("<span class='error-message text-danger'><small>Please enter a valid phone number of 10 digits<small/></span>");
      } else {
        $(this).removeClass("error");
        $(this).siblings(".error-message").remove(); // Remove existing error message if present
        Swal.fire({
          html: `
            <div class="my-2">
              <input class="form-control" type='text' id="phoneOTP" placeholder="Enter OTP sent to your phone number">
            </div>
            <div class="p-1">
              <small id="PhoneOtpMessage">sending...<small>
            </div>    
            <div class="row mx-0">
              <div class="col"><button class="btn btn-primary btn-sm w-100" id="verifyPhone" disabled>verify</button></div>
              <div class="col"><button class="btn btn-warning btn-sm w-100" id="resendPhone" disabled>resend OTP</button></div>
            </div>
          `,
          showConfirmButton: false,
          allowOutsideClick: false,
        });
        $('#verifyPhone').prop('disabled');
        $('#resendPhone').prop('disabled');

        $.ajax({
          url: "{{ route('sms-otp') }}",
          type: "POST",
          data: {phone:phone},
          success: function (res) {
            $('#verifyPhone').prop('disabled', false);
            console.log(res);
            $('#PhoneOtpMessage').html('OTP has been sent to your phone number. ');
            $('#PhoneOtpMessage').addClass('text-success');

            setTimeout(function() {
              $('#resendPhone').prop('disabled', false);
            }, (14 * 60 * 1000) + (50 * 1000));
          }
        });
      }
    });

    // resend phone otp
    $(document).on('click', '#resendPhone', function (e) {
      const phone = $('#phone').val();

      $.ajax({
        url: "{{ route('sms-otp') }}",
        type: "POST",
        data: {phone:phone},
        success: function (res) {
          $('#PhoneOtpMessage').html('OTP has been resent to your phone.');
          $('#PhoneOtpMessage').removeClass('text-danger');
          $('#PhoneOtpMessage').addClass('text-success');
        }
      })
    });

    // verify phone otp
    $(document).on('click', '#verifyPhone', function (e) {
        e.preventDefault();
        const userOTP = $('#phoneOTP').val();
        $.ajax({
            url: "{{ route('verify-phone') }}",
            type: "POST",
            data: {userOTP:userOTP},
            success: function(res) {
                if (res.message === 'matching') {
                    Swal.fire({
                      title: "Phone verified successfully!",
                      showConfirmButton: false,
                      timer: 1500
                    });
                    $('#phoneOtpStatus').val('done');
                    $('#phoneVerification').html(`<i class="mdi mdi-check"></i>`);
                    $('#phoneVerification').addClass('btn-outline-primary').removeClass('btn-success');
                    $('#phoneVerification').prop('disabled');
                } else if (res.message === 'invalid') {
                    $('#PhoneOtpMessage').html('OTP may expired. Please resend.');
                    $('#PhoneOtpMessage').removeClass('text-success');
                    $('#PhoneOtpMessage').addClass('text-danger');
                    $('#resendPhone').prop('disabled', false);
                } else {
                    $('#PhoneOtpMessage').html('OTP is not matching.');
                    $('#PhoneOtpMessage').removeClass('text-success');
                    $('#PhoneOtpMessage').addClass('text-danger');
                    $('#resendPhone').prop('disabled', false);
                }
            }
        });  
    })

    // Email verification using OTP
    $('#emailVerification').on('click', function (e) {
      e.preventDefault();
      const email = $('#email').val();

      const regex = /^[\w\-\.]+@([\w-]+\.)+[\w-]{2,}$/;
      const isValid = regex.test(email);

      if (!isValid || email === '') {
        $(this).parent(".input-group").addClass("error");
        $(this).parent(".input-group").siblings(".error-message").remove();
        $(this).parent(".input-group").after("<span class='error-message text-danger'><small>Please enter a valid email address.<small/></span>");
      } else {
        $(this).parent(".input-group").removeClass("error");
        $(this).parent(".input-group").siblings(".error-message").remove();
        Swal.fire({
          html: `
            <div class="my-2">
              <input class="form-control" type='text' id="emailOTP" placeholder="Enter OTP sent to your email">
            </div>
            <div class="p-1">
              <small class="EmailOtpMessage">sending...<small>
            </div>    
            <div class="row mx-0">
              <div class="col"><button class="btn btn-primary btn-sm w-100" id="verifyEmail" disabled>verify</button></div>
              <div class="col"><button class="btn btn-warning btn-sm w-100" id="resendEmail" disabled>resend OTP</button></div>
            </div>
          `,
          showConfirmButton: false,
          allowOutsideClick: false,
        });
        $('#verifyEmail').prop('disabled');
        $('#resendEmail').prop('disabled');

        $.ajax({
          url: "{{ route('email-otp') }}",
          type: "POST",
          data: {email:email},
          success: function (res) {
            $('#verifyEmail').prop('disabled', false);
            console.log(res);
            $('#EmailOtpMessage').html('OTP has been sent to your email. ');
            $('#EmailOtpMessage').addClass('text-success');

            setTimeout(function() {
              $('#resendEmail').prop('disabled', false);
            }, (14 * 60 * 1000) + (58 * 1000));
          }
        });
      }
    })

    $(document).on('click', '#resendEmail', function () {
      const email = $('#email').val();

      // Resend OTP logic
      $.ajax({
        url: "{{ route('email-otp') }}",
        type: "POST",
        data: {email: email},
        success: function (res) {
          console.log(res);
          $('#EmailOtpMessage').html('OTP has been resent to your email. ');
          $('#EmailOtpMessage').addClass('text-success');
        }
      });
    });

    $(document).on('click', '#verifyEmail', function (e) {
        e.preventDefault();
        const userOTP = $('#emailOTP').val();
        $.ajax({
            url: "{{ route('verify-email') }}",
            type: "POST",
            data: {userOTP:userOTP},
            success: function(res) {
                if (res.message === 'matching') {
                    Swal.fire({
                      title: "Email verified successfully!",
                      showConfirmButton: false,
                      timer: 1500
                    });
                    $('#emailOtpStatus').val('done');
                    $('#emailVerification').html(`<i class="mdi mdi-check"></i>`);
                    $('#emailVerification').addClass('btn-outline-primary').removeClass('btn-success');
                    $('#emailVerification').prop('disabled');
                } else if (res.message === 'invalid') {
                    $('#EmailOtpMessage').html('OTP may expired. Please resend.');
                    $('#EmailOtpMessage').addClass('text-danger');
                    $('#resendEmail').prop('disabled', false);
                } else {
                    $('#EmailOtpMessage').html('OTP is not matching.');
                    $('#EmailOtpMessage').addClass('text-danger');
                    $('#resendEmail').prop('disabled', false);
                }
            }
        });  
    })
  });

  // when different phone number is used
  $(document).on('input', '#phone', function() {
    $('#phoneVerification').html('verfiy');
  });

  // when different email is used
  $(document).on('input', '#email', function () {
    $('#emailVerification').html('verify');
  })
  </script>

<x-main-footer/>