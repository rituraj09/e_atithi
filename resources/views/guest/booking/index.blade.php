<!-- resources/views/guestHouse/GuestHouse/view.blade.php -->

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-guest.guest-navbar/>

            <div class="page-content" style="background-color: #f1fcff">
                <div>
                    <div class="card row mb-2 p-3">
                        <div class="d-flex mb-2 flex-wrap">
                            <div class="wd-300">
                                <h3>Guest House</h3>
                                <p>Golaghat, Assam</p>
                                <p>12/03/2024</p>
                                <p>15/03/2024</p>
                            </div>
                            <div class="d-flex flex-wrap">
                                <div class="p-1">
                                    <img class="image-filler" src="https://www.contemporist.com/wp-content/uploads/2017/02/minimalist-modern-house-exteriors-030217-424-06a-800x856.jpg" alt="">
                                </div>
                                <div class="p-1">
                                    <img class="image-filler" src="https://www.contemporist.com/wp-content/uploads/2017/02/minimalist-modern-house-exteriors-030217-424-06a-800x856.jpg" alt="">
                                </div>
                                <div class="p-1">
                                    <img class="image-filler" src="https://www.contemporist.com/wp-content/uploads/2017/02/minimalist-modern-house-exteriors-030217-424-06a-800x856.jpg" alt="">
                                </div>
                                <div class="p-1">
                                    <img class="image-filler" src="https://www.contemporist.com/wp-content/uploads/2017/02/minimalist-modern-house-exteriors-030217-424-06a-800x856.jpg" alt="">
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
                        <table class="table">
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
                                    <th>
                                        Select
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>R101</td>
                                    <td>
                                        <div>
                                            vip
                                        </div>
                                    </td>
                                    <td>1</td>
                                    <td>700/-</td>
                                    <td>
                                        <input type="checkbox" name="" id="">
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3">Total</td>
                                    <td>1400/-</td>
                                    <td>
                                        <input class="btn btn-sm btn-primary" type="text" value="book">
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
