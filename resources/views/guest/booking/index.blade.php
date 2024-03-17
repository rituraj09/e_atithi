<!-- resources/views/guestHouse/GuestHouse/view.blade.php -->

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-guest.guest-navbar/>

            <div class="page-content" style="background-color: #f1fcff">
                <div>
                    <div class="card row mb-2 p-3">
                        <div class="d-flex col-md-10 mx-auto mb-2 flex-wrap">
                            <x-page-header :title="'Guest House'" />
                            <div class="image-wrapper">
                                <div>
                                    <img class="image-filler" src="https://www.contemporist.com/wp-content/uploads/2017/02/minimalist-modern-house-exteriors-030217-424-06a-800x856.jpg" alt="">
                                </div>
                                <div>
                                    <img class="image-filler" src="https://www.contemporist.com/wp-content/uploads/2017/02/minimalist-modern-house-exteriors-030217-424-06a-800x856.jpg" alt="">
                                </div>
                                <div>
                                    <img class="image-filler" src="https://www.contemporist.com/wp-content/uploads/2017/02/minimalist-modern-house-exteriors-030217-424-06a-800x856.jpg" alt="">
                                </div>
                                <div>
                                    <img class="image-filler" src="https://www.contemporist.com/wp-content/uploads/2017/02/minimalist-modern-house-exteriors-030217-424-06a-800x856.jpg" alt="">
                                </div>
                            </div>
                            <div class="row my-2 w-100">
                                <div class="col-md-6">
                                    <h3>{{ $guestHouse->name }}</h3>
                                    <p>Golaghat, Assam</p>
                                </div>
                                <div class="col-md-6 text-end">
                                    <p>12/03/2024</p>
                                    <p>15/03/2024</p>
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
                                        <select name="" id="" class="form-control">
                                            <option value="" selected disabled>--select--</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="" class="col-md-4 mb-2">Room Category</label>
                                    <div class="col-md-8 mb-2">
                                        <select name="roomCategory" id="roomCategory" class="form-control">
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
                                        <input type="file" class="form-control">
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
                                            <input class="form-check-input m-auto" role="switch" type="checkbox" name="roomSelect" id="roomSelect">
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
                                        <button type="button" class="btn btn-sm btn-primary" type="text" >book</button>
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
        $(document).ready(function() {
            // $('tr').addClass('bg-primary bg-opacity-10');
            $('input[name="roomSelect"]').change(function() {
                // console.log($(this));
                if ( $(this).prop('checked') ) {
                    $(this).closest('tr').addClass('bg-selected');
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
