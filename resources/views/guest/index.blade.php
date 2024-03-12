<!-- resources/views/guestHouse/GuestHouse/view.blade.php -->

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-guest.guest-navbar/>

            <div class="page-content" style="background-color: #f1fcff">
                <div class="">
                    <div class="row justify-content-center align-items-center mt-5 mb-3 container-sm mx-auto">
                         <div class="col-md-4 p-0">
                             <div class="mb-2 ">
                                 <label for="" class="fs-5 fw-bold text-secondary">Guest House</label>
                             </div>
                             <div class="input-group form-control p-0">
                                 <span class="mdi mdi-magnify m-auto fs-4 ms-2 text-secondary"></span>
                                 <input type="text" class="form-control border-0" placeholder="search guest house or place">
                             </div>
                         </div>
                         <div class="col-md-3 p-0">
                             <div class="mb-2 text-md-center">
                                 <label class="fs-5 fw-bold text-secondary">Checkin Date</label>
                             </div>
                             <div class="input-group col-md-8 flatpickr me-2 mb-2 mb-md-0" id="">
                                 <input type="date" class="form-control " id="from" name="ckeckin" placeholder="Select date" data-input>
                               </div>
                         </div>
                         <div class="col-md-3 p-0">
                             <div class="mb-2 text-md-center">
                                 <label class="fs-5 fw-bold text-secondary">Checkout Date</label>
                             </div>
                             <div class="input-group col-md-8 flatpickr me-2 mb-2 mb-md-0" id="">
                                 <input type="date" class="form-control " id="to" name="ckeckout" placeholder="Select date" data-input>
                               </div>
                         </div>
                         <div class="col-md-2 p-0">
                            <div class="mb-2 text-md-center">
                                <label class="fs-5 fw-bold text-secondary" for="">Rooms</label>
                            </div>
                            <select class="form-control" name="" id="">
                                <option value="" selected disabled>--select--</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                            </select>
                         </div>
                    </div>
                    <div class="d-flex justify-content-end container-sm pt-auto mb-5">
                        <div class="col-md-2">
                            <button class="btn btn-primary w-100 mb-0 mt-auto">Search</button>
                        </div>
                    </div>
 
                    <div class="row m-0 continainer">
                        <div class="col-md-6 p-2">
                            <div class="card mb-3 shadow-sm">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="https://www.thespruce.com/thmb/zwsJE_aYKwL20wwKBOmwn0pXoTQ=/960x0/filters:no_upscale():max_bytes(150000):strip_icc()/Colorful-Art-Studio-Garden-in-California_5-3221e3e172f442c09d844c1d872d3162.jpg" class="img-fluid rounded-start" alt="...">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body p-3">
                                            <h5>Guest House Name</h5>
                                            <p class="card-text mb-1"><small class="text-body-secondary">Golaghat, Assam</small></p>
                                            <p class="card-text text-truncate">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 p-2">
                            <div class="card mb-3 shadow-sm">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="https://www.thespruce.com/thmb/zwsJE_aYKwL20wwKBOmwn0pXoTQ=/960x0/filters:no_upscale():max_bytes(150000):strip_icc()/Colorful-Art-Studio-Garden-in-California_5-3221e3e172f442c09d844c1d872d3162.jpg" class="img-fluid rounded-start" alt="...">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body p-3">
                                            <h5>Guest House Name</h5>
                                            <p class="card-text mb-1"><small class="text-body-secondary">Golaghat, Assam</small></p>
                                            <p class="card-text text-truncate">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
            </div>
        </div>
    </div>

    <!-- Custom js for this page -->
    <script>

    $(document).ready(function () {
        var today = new Date();

        // var today = DateFormmate('yyyy-mm-dd');
        $('#from').prop('min', function () {
            return today.toISOString().split('T')[0];
        })
        $('#to').prop('min', function () {
            return today.toISOString().split('T')[0];
        })
        // $('#to').prop('min', function () {
        //     return today.toISOString().split('T')[0];
        // })

        var f;
        $('#from').on('change', function () {
            f = $(this).val();
            $('#to').prop('min', function () {
                return f;
            })
        })

        var t;
        $('#to').on('change', function () {
            t = $(this).val();
            $('#from').prop('max', function () {
                return t;
            })
        })
    })

    </script>

    <script>
        // $( function() {
        //     var dateFormat = "dd/mmm/yy",
        //         from = $( "#from" )
        //             .datepicker({
        //                 defaultDate: "+1w",
        //                 changeMonth: true,
        //                 numberOfMonths: 3
        //             })
        //             .on( "change", function() {
        //                 to.datepicker( "option", "minDate", getDate( this ) );
        //             }),
        //         to = $( "#to" ).datepicker({
        //             defaultDate: "+1w",
        //             changeMonth: true,
        //             numberOfMonths: 3
        //         })
        //         .on( "change", function() {
        //             from.datepicker( "option", "maxDate", getDate( this ) );
        //         });

        //     function getDate( element ) {
        //         var date;
        //         try {
        //             date = $.datepicker.parseDate( dateFormat, element.value );
        //         } catch( error ) {
        //             date = null;
        //         }

        //         return date;
        //     }
        // } );
	</script>

    <style>
        .ui-draggable, .ui-droppable {
	background-position: top;
}
    </style>

<x-main-footer/>
