<x-guest.header />

    <div class="main-wrapper" id="app">
        <div class="horizontal-menu">

        <x-guest.top-navbar />
        <x-guest.bottom-navbar />

        </div>
        <div class="page-wrapper">
            <div class="page-content">
                <div class="d-flex justify-content-center h-100 align-items-center flex-wrap grid-margin">
                   <div class="w-100 d-flex">
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
                            <button class="btn btn-primary">Search</button>
                        </div>
                   </div>
                </div>
            </div>
            
<x-guest.guest-footer />