<!-- resources/views/guestHouse/GuestHouse/view.blade.php -->

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-guest.guest-navbar/>

            <div class="page-content" style="background-color: #f1fcff">
                <div class="">
                    <div class="row m-auto hd-100 w-100">
                        <span class="text-center fs-2 fw-bold text-primary text-capitalize">
                            Wellcome Back 
                            <small class="fs-4 fw-normal text-dark">
                            @if (auth()->guard('guest')->user())
                                {{ auth()->guard('guest')->user()->name }}
                            @endif
                            </small>
                        </span>
                    </div>
                    <div class="row justify-content-center align-items-start mt-5 mb-3 container-sm mx-auto">
                        <div class="col-md-6 p-0">
                            <div class="mb-2 ">
                                <label for="" class="fs-5 fw-bold text-secondary">Guest House</label>
                            </div>
                            <div class="input-group form-control p-0">
                                <span class="mdi mdi-magnify m-auto fs-4 ms-2 text-secondary"></span>
                                <input type="text" class="form-control outline-0 border-0" id="search" >
                            </div>
                            <div>
                               <input type="hidden" id="dataId">
                               <input type="hidden" id="dataType">
                            </div>
                            <div id="search-result">
                               {{-- search results here --}}
                            </div>
                        </div>
                        <div class="col-md-3 p-0">
                            <div class="mb-2 text-md-center">
                                <label class="fs-5 fw-bold text-secondary">Checkin Date</label>
                            </div>
                            <div class="input-group col-md-8 flatpickr me-2 mb-2 mb-md-0" id="">
                                <input type="date" class="form-control " id="from" name="ckeckin" placeholder="Select date" data-input required>
                            </div>
                        </div>
                        <div class="col-md-3 p-0">
                            <div class="mb-2 text-md-center">
                                <label class="fs-5 fw-bold text-secondary">Checkout Date</label>
                            </div>
                            <div class="input-group col-md-8 flatpickr me-2 mb-2 mb-md-0" id="">
                                <input type="date" class="form-control " id="to" name="ckeckout" placeholder="Select date" data-input required>
                            </div>
                            <div class="mt-5">
                                <button class="btn btn-primary w-100 mb-0 mt-auto" id="search-houses">Search</button>
                            </div>
                        </div>
                    </div>
 
                    <div class="container-sm" id="searchResult">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom js for this page -->
    <script>
    $(document).ready( function () {
        $('#search').on('input', function () {
            $("#search-result").show();
            var search = $(this).val();
            var searchUrl = `{{ route('search-guest-house') }}`;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: searchUrl,
                type: 'POST',
                data: {search: search},
                success: function (res) {
                    console.log(res);
                    let html = '<div id="search-result"><ul>';
                    
                    // Append district results
                    html += res.districts.map(data => `
                        <li data-type="location" data-id="${data.id}">
                            <div class="d-flex">
                                <div class="px-2">
                                    <span class="mdi mdi-map-marker-outline fs-3"></span>
                                </div>
                                <div class="col ps-2">
                                    <b class="text-darkgray text-capitalize" data-name="${data.name}">${data.name}</b>
                                    <p>${data.state_name}</p>
                                </div>
                            </div>
                        </li>
                    `).join('');
                    
                    // Append guest house results
                    html += res.guestHouses.map(data => `
                        <li data-type="guestHouse" data-id="${data.id}">
                            <div class="d-flex">
                                <div class="px-2">
                                    <span class="mdi mdi-home-city-outline fs-3"></span>
                                </div>
                                <div class="col ps-2">
                                    <b class="text-darkgray text-capitalize" data-name="${data.guest_house_name}">${data.guest_house_name}</b>
                                    <p>${data.district_name}, ${data.state_name}</p>
                                </div>
                            </div>
                        </li>
                    `).join('');
                    
                    html += '</ul></div>';
                    
                    $('#search-result').html(html); // Replace the content of the search-result div with the generated HTML
                }
            });

        })
    })

    $(document).on('click', '#search-result ul li', function() {
        const dataId = $(this).data('id');
        const listType = $(this).data('type'); 
        const searchResult = $(this).find('b').data("name");
        // var selectedResult = $(this);
        console.log(listType);
        console.log(dataId);
        $("#dataId").val(dataId);
        $("#dataType").val(listType);
        $("#search").val(searchResult);
        $("#search-result").hide();
    });

    $(document).ready(function () {
        $("#search-houses").on('click', function () {
            // var guestHouse = $('#guest-house').val();
            var dataId = $('#dataId').val();
            var dataType = $('#dataType').val();
            var checkin = $('#from').val();
            var checkout = $('#to').val();

            // console.log("date "+ checkout);
            if (dataId === "" && $("#search").val() === "") {
                Swal.fire("Please select a Guest House or Location.");
            } else if (dataId === "" && $("#search").val() !== "") {
                Swal.fire("Please re-select a Guest House or Location.");
            } else if (checkin === "") {
                Swal.fire("Please select a check-in date");
            } else if (checkout === "") {
                Swal.fire("Please select a check-out date");
            } else {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: "{{ route('get-guest-houses') }}",
                    type: 'POST',
                    data: {
                        dataId:dataId,
                        dataType:dataType,
                        checkin: checkin,
                        checkout: checkout,
                    },
                    success: function(res) {
                        console.log(res)
                        $('#searchResult').html();
                        var guestHouseCard;
                        if (Array.isArray(res)) {
                            guestHouseCard = res.map(data =>`
                                <div class="">
                                    <div class="card mb-3 shadow-sm mb-3">
                                        <div class="row g-0">
                                            <div class="col-md-4">
                                                <img class="card-image" src="https://www.thespruce.com/thmb/zwsJE_aYKwL20wwKBOmwn0pXoTQ=/960x0/filters:no_upscale():max_bytes(150000):strip_icc()/Colorful-Art-Studio-Garden-in-California_5-3221e3e172f442c09d844c1d872d3162.jpg" class="img-fluid rounded-start" alt="...">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body p-3">
                                                    <h5>${data.name}</h5>
                                                    <p class="card-text mb-1"><small class="text-body-secondary">${data.district_name.name}, ${data.state_name.name}</small></p>
                                                    <ul>
                                                        <li>daafa</li>
                                                        <li>a j  ak  nskdjak ajsn</li>
                                                    </ul>
                                                    <p class="card-text text-truncate">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
                                                    <div class="d-flex justify-content-end pt-2">
                                                        <button data-id="${data.id}" class="btn btn-outline-success pt-1 check-guest-house">
                                                            Check availablity
                                                            <span class="mdi mdi-chevron-double-right"></span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `).join('');
                        } else {
                            guestHouseCard = `
                                <div class="">
                                    <div class="card mb-3 shadow-sm mb-3">
                                        <div class="row g-0">
                                            <div class="col-md-4">
                                                <img class="card-image" src="https://www.thespruce.com/thmb/zwsJE_aYKwL20wwKBOmwn0pXoTQ=/960x0/filters:no_upscale():max_bytes(150000):strip_icc()/Colorful-Art-Studio-Garden-in-California_5-3221e3e172f442c09d844c1d872d3162.jpg" class="img-fluid rounded-start" alt="...">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body p-3">
                                                    <h5>${res.name}</h5>
                                                    <p class="card-text mb-1"><small class="text-body-secondary">${res.district_name.name}, ${res.state_name.name}</small></p>
                                                    <ul>
                                                        <li>daafa</li>
                                                        <li>a j  ak  nskdjak ajsn</li>
                                                    </ul>
                                                    <p class="card-text text-truncate">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
                                                    <div class="d-flex justify-content-end pt-2">
                                                        <button data-id="${res.id}" class="btn btn-outline-success pt-1 check-guest-house">
                                                            Check availablity
                                                            <span class="mdi mdi-chevron-double-right"></span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                        }

                        $('#searchResult').html(guestHouseCard);
                    }
                    
                });

            }
        });
    })

    $(document).on('click', '.check-guest-house', function () {
        var id = $(this).data('id');
        var checkin = $('#from').val();
        var checkout = $('#to').val();

        var bookUrl = "{{ route('show-guest-house', [':id',':checkin',':checkout']) }}";
        bookUrl = bookUrl.replace(':id', id);
        bookUrl = bookUrl.replace(':checkin', checkin);
        bookUrl = bookUrl.replace(':checkout', checkout);
        // bookUrl = bookUrl.replace([':id', ':checkin', ':checkout'], [id, checkin, checkout]);
        console.log(bookUrl);
        window.location.href = bookUrl;
        console.log(id);
    });


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
        // })      max 3 month

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
