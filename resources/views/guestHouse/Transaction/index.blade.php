<!-- resources/views/guestHouse/Transaction/index.blade.php -->

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-admin.navbar/>

            <div class="page-content">

                <x-page-header :title="'Transaction'"/>
                <div class="d-flex flex-column border card">
                    <div class="d-none col nav nav-tabs bg-light pt-2 px-2">
                        <div>
                            <a href="{{ route('all-reservations') }}" class="text-capitalize nav-link active px-4 fw-bold">
                                view
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('create-reservation') }}" class="text-capitalize nav-link">
                                add
                            </a>
                        </div>
                    </div>
                    <div class="p-2">
                        <div class="row m-0">
                            <div class="col-md-8 py-3">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="reservation_id">
                                    <button class="btn btn-outline-primary" id="search">
                                        Search
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-md-6 mb-3">
                                Name
                            </div>
                            <div class="col-md-6 mb-3">
                                Name
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                    <th>Room No</th>
                                    <th>Room Type</th>
                                    <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody id="">
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function () {
        $('#search').on('click', function () {
            const rid = $('#reservation_id').val();

            $.ajax({
                url: "{{ url('ajax/fetchReservation') }}/" + rid,
                type: "GET",
                success: function (res) {
                    console.log(res);
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });


    </script>

<x-main-footer/>