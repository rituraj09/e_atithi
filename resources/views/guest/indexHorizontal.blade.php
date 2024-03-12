<x-guest.header />

    <div class="main-wrapper" id="app">
        <div class="horizontal-menu">

        <x-guest.top-navbar />
        <x-guest.bottom-navbar />

        </div>
        <div class="page-wrapper">
            <div class="page-content">
                <div class="">
                   <div class="w-100 h-100 d-flex justify-content-center align-items-center mb-5">
                        <div class="col-md-4">
                            <div class="mb-2 text-center">
                                <label for="" class="fs-5 fw-bold">Guest House</label>
                            </div>
                            <div class="input-group">
                                <span class="mdi mdi-search"></span>
                                <input type="text" class="form-control" placeholder="search guest house or place">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-2 text-center">
                                <label class="fs-5 fw-bold text-center">Checkin Date</label>
                            </div>
                            <div class="input-group col-md-8 flatpickr me-2 mb-2 mb-md-0" id="dashboardDate">
                                <input type="text" class="form-control bg-transparent" name="ckeckin" placeholder="Select date" data-input>
                              </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-2 text-center">
                                <label class="fs-5 fw-bold text-center">Checkout Date</label>
                            </div>
                            <div class="input-group col-md-8 flatpickr me-2 mb-2 mb-md-0" id="dashboardDate">
                                <input type="text" class="form-control bg-transparent" name="ckeckout" placeholder="Select date" data-input>
                              </div>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary mb-0 mt-auto">Search</button>
                        </div>
                   </div>

                   <div class="row">
                        <div class="col-md-6 p-2">
                            <div class="card">
                                <div class="card-body">a</div>
                                <div class="card-title">Card</div>
                            </div>
                        </div>
                   </div>
                </div>
            </div>
            
<x-guest.guest-footer />