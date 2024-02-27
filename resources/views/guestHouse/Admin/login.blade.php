
<x-header/>

<body>
	<div class="main-wrapper">
		<div class="page-wrapper full-page">
			<div class="page-content d-flex align-items-center justify-content-center">

				<div class="row w-100 mx-0 auth-page">
					<div class="col-md-8 col-xl-6 mx-auto">
						<div class="card rounded-4 shadow">
							<div class="row">
                <div class="col-md-4 pe-md-0">
                  <div class="auth-side-wrapper rounded-end rounded-4">

                  </div>
                </div>
                <div class="col-md-8 ps-md-0">
                  <div class="auth-form-wrapper px-4 py-5">
                    <a href="#" class="noble-ui-logo logo-light d-block mb-2"><span>e</span>Atithi</a>
                    <h5 class="text-muted fw-normal mb-4">Welcome back! Log in to your account.</h5>
                    <form class="form-sample" action="{{ route('admin-login')}}" method="post">
                        @csrf 
                      <div class="mb-3">
                        <label for="userEmail" class="form-label">Email address</label>
                        <input type="email" class="form-control" name="email" id="userEmail" placeholder="Email" required>
                      </div>
                      <div class="mb-3">
                        <label for="userPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="userPassword" autocomplete="current-password" placeholder="Password" required>
                      </div>
                      <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="authCheck">
                        <label class="form-check-label" for="authCheck">
                          Remember me
                        </label>
                      </div>
                      <div>
                        <input type="submit" class="btn btn-primary rounded-4 me-2 mb-2 mb-md-0 text-white" value="Login"/>
                      </div>
                      <a href="{{ route('guest-house-admin-registration')}}" class="d-block mt-3 text-muted">Not a user? Sign up</a>
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

<x-main-footer/>