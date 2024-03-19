<!-- resources/views/guestHouse/GuestHouse/view.blade.php -->

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-guest.guest-navbar/>

            <div class="page-content" style="background-color: #f1fcff">
                <div>
                    <div class="card row mb-2 p-3">
                        <div class="d-flex col-md-10 mx-auto my-2 flex-wrap">
                            <x-page-header :title="'Guest House'" />

                            {{-- <div class="main-image-container">
                                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img src="https://www.contemporist.com/wp-content/uploads/2017/02/minimalist-modern-house-exteriors-030217-424-06a-800x856.jpg" class="d-block wd-300" alt="...">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="https://www.contemporist.com/wp-content/uploads/2017/02/minimalist-modern-house-exteriors-030217-424-06a-800x856.jpg" class="d-block wd-300" alt="...">
                                        </div>
                                        <div class="carousel-item">
                                            <img src="https://www.contemporist.com/wp-content/uploads/2017/02/minimalist-modern-house-exteriors-030217-424-06a-800x856.jpg" class="d-block wd-300" alt="...">
                                        </div>
                                    </div>
                                    <a class="carousel-control-prev" data-bs-target="#carouselExampleControls" role="button" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" data-bs-target="#carouselExampleControls" role="button" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </a>
                                </div>
                            </div> --}}
                            {{-- <div class="d-md-flex mx-2">
                                <div>
                                    <img class="image-filler" src="https://www.contemporist.com/wp-content/uploads/2017/02/minimalist-modern-house-exteriors-030217-424-06a-800x856.jpg" style="grid-area: A;" alt="">
                                </div>
                                <div>
                                    <img class="image-filler" src="https://www.contemporist.com/wp-content/uploads/2017/02/minimalist-modern-house-exteriors-030217-424-06a-800x856.jpg" style="grid-area: A;" alt="">
                                </div>
                            </div> --}}
                            
                            <div class="image-wrapper">
                                <div>
                                    <img class="image-filler" src="https://www.contemporist.com/wp-content/uploads/2017/02/minimalist-modern-house-exteriors-030217-424-06a-800x856.jpg" style="grid-area: A;" alt="">
                                </div>
                                <div>
                                    <img class="image-filler" src="https://www.contemporist.com/wp-content/uploads/2017/02/minimalist-modern-house-exteriors-030217-424-06a-800x856.jpg" style="grid-area: B;" alt="">
                                </div>
                                <div>
                                    <img class="image-filler" src="https://www.contemporist.com/wp-content/uploads/2017/02/minimalist-modern-house-exteriors-030217-424-06a-800x856.jpg" style="grid-area: C;" alt="">
                                </div>
                                <div>
                                    <img class="image-filler" src="https://www.contemporist.com/wp-content/uploads/2017/02/minimalist-modern-house-exteriors-030217-424-06a-800x856.jpg" style="grid-area: D;" alt="">
                                </div>
                            </div>
                            <div class="row mx-0 my-2 w-100">
                                <div class="col-md px-0">
                                    <h3>{{ $guestHouse->name }}</h3>
                                    <small>Golaghat, Assam</small>
                                </div>
                                <div class="col-md text-md-end px-0 text-dark">
                                    <p><small>From</small> {{ $checkInDate }}</p>
                                    <p><small>to</small> {{ $checkOutDate }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="mb-2 col-md-10 mx-auto">
                            <form action="" method="post" class="form">
                                @csrf
                                {{-- <div class="row">
                                    <label for="" class="col-md-4 mb-2">Checkin Date</label>
                                    <div class="col-md-8 mb-2">
                                        <input type="date" id="from" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="" class="col-md-4 mb-2">Checkout Date</label>
                                    <div class="col-md-8 mb-2">
                                        <input type="date" id="to" class="form-control">
                                    </div>
                                </div> --}}
                                <div class="row">
                                    <label for="" class="col-md-4 mb-2">Reason for visiting</label>
                                    <div class="col-md-8 mb-2">
                                        <select name="" id="visitingReason" class="form-control">
                                            <option value="" selected disabled>--select--</option>
                                            <option value="personal">Personal</option>
                                            <option value="official">Official</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="" class="col-md-4 mb-2">Room Category</label>
                                    <div class="col-md-8 mb-2">
                                        <select name="roomCategory" id="roomCategory" class="form-control text-capitalize">
                                            <option value="" selected disabled>--select--</option>
                                            @foreach ($roomCategories as $roomCategory)
                                                <option value="{{ $roomCategory->id }}">{{ $roomCategory->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="" class="col-md-4 mb-2">ID Proof</label>
                                    <div class="col-md-8 mb-2">
                                        <input name="idFIle" id="idFile" type="file" class="form-control">
                                    </div>
                                </div>
                                <div class="row hidden">
                                    <label for="" class="col-md-4 mb-2">Occupency</label>
                                    <div class="col-md-8 mb-2">
                                        <input type="text" class="form-control" placeholder="Occupency (optional)">
                                    </div>
                                </div>

                                <div class="row">
                                    <label for="" class="col-md-4 mb-2">Remarks</label>
                                    <div class="col-md-8 mb-2">
                                        <textarea name="" id="" cols="30" rows="3" class="form-control"></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="responsive-table card">
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th>
                                        Room Number
                                    </th>
                                    <th>
                                        Room Type
                                    </th>
                                    <th>
                                        Capacity
                                    </th>
                                    <th>
                                        Price per night
                                    </th>
                                    <th class="text-center">
                                        Select
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ( $rooms as $room )
                                <tr>
                                    <td>{{ $room->room_number }}</td>
                                    <td>
                                        <div class="text-capitalize">
                                            {{ $room->roomRate->roomCategory->name }},
                                            {{ $room->roomRate->name }}
                                        </div>
                                    </td>
                                    <td>{{ $room->capacity }}</td>
                                    <td class="price text-end pe-3">{{ $room->roomRate->price }}</td>
                                    <td>
                                        <div class="form-check form-switch me-0 px-auto">
                                            <input class="form-check-input m-auto" role="switch" type="checkbox" name="roomSelect" id="roomSelect" data-id="{{ $room->id }}">
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="text-center">Total</td>
                                    <td class="text-end" id="total" colspan="3">0.00</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary" type="text" id="book">book</button>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom js for this page -->
    <script>
    $(document).ready(function () {
        var guestHouse = "{{ $guestHouse->id }}";
        var checkin = "{{ $checkInDate }}";
        var checkout = "{{ $checkOutDate }}";
        var visitingReason = $('#visitingReason').val();
        var roomCategory = $('#roomCategory').val();
        var doc = $('#idFile').val();
        var rooms = [];


        $('input[name="roomSelect"]').each(function() {
            $(this).prop('checked', false);
        });


        $('#book').on('click', function() {
            console.log(rooms, visitingReason, roomCategory);

            $.ajax({
                url: "{{ route('new-booking') }}",
                type: "POST",
                data: {
                    rooms:rooms,
                    visitingReason:visitingReason,
                    roomCategory:roomCategory,
                    checkin:checkin,
                    checkout:checkout,
                    guestHouse:guestHouse,
                    doc:doc,
                }
                success: function(res){
                    
                }
            })

            // Swal.fire({
            //     title: "Submit your Github username",
            //     input: "text",
            //     inputAttributes: {
            //         autocapitalize: "off"
            //     },
            //     showCancelButton: true,
            //     confirmButtonText: "Look up",
            //     showLoaderOnConfirm: true,
            //     preConfirm: async (login) => {
            //         try {
            //             const githubUrl = `
            //                 https://api.github.com/users/${login}
            //             `;
            //             const response = await fetch(githubUrl);
            //             if (!response.ok) {
            //                 return Swal.showValidationMessage(`
            //                 ${JSON.stringify(await response.json())}
            //                 `);
            //             }
            //             return response.json();
            //         } catch (error) {
            //             Swal.showValidationMessage(`
            //                 Request failed: ${error}
            //             `);
            //         }
            //     },
            //     allowOutsideClick: () => !Swal.isLoading()
            //     }).then((result) => {
            //         if (result.isConfirmed) {
            //             Swal.fire({
            //             title: `${result.value.login}'s avatar`,
            //             imageUrl: result.value.avatar_url
            //         });
            //     }
            // });
        });

        $('input[name="roomSelect"]').change(function() {
            // console.log($(this));
            if ( $(this).prop('checked') ) {
                $(this).closest('tr').addClass('bg-selected');
                rooms.push($(this).data('id'));
            } else {
                $(this).closest('tr').removeClass('bg-selected');
                // $(this).closest('tr').addClass('bg-white');
            }
            var total = 0;
            $('input[name="roomSelect"]:checked').each(function() {
                var price = parseFloat($(this).closest('tr').find('.price').text());
                total += price;
            });
            $('#total').html(total.toFixed(2)); // Assuming you want to display the total with 2 decimal places
        });
    });


        $(document).ready(function() {
            // $('tr').addClass('bg-primary bg-opacity-10');
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

<x-main-footer/>
