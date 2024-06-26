<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper full-page">
            <div class="page-content d-flex align-items-center justify-content-center">

                <div class="row w-100 mx-0 auth-page">
                    <div class="col-md-8 col-xl-6 mx-auto d-flex flex-column align-items-center">
                        <img src="{{ asset('assets/images/others/404.svg') }}" class="img-fluid mb-2" alt="500">
                        <h1 class="fw-bolder mb-22 mt-2 tx-80 text-muted">500</h1>
                        <h4 class="mb-2">Internal server error</h4>
                        <h6 class="text-muted mb-3 text-center">Oopps!! There wan an error. Please try agin later.</h6>
                        <div class="row">
                            <div class="col">
                                <a href="{{ URL::previous() }}">Back</a>
                            </div>
                            <div class="col">
                                <a href="/">Home</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

<x-main-footer/>