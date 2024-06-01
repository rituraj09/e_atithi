<!-- resources/views/guestHouse/Transaction/index.blade.php -->

{{-- {{ dd($bills); }} --}}

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-admin.navbar/>

            <div class="page-content">
                <x-page-header :title="'Manage Bills'"/>
                <div class="d-flex flex-column border card">
                    <div class="col nav nav-tabs bg-light pt-2 px-2">
                        <div>
                            <button class="text-capitalize nav-link active px-4 fw-bold">
                                view
                            </button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        {{-- data from room transactions only --}}
                        <table id="example" class="table">
                            <thead>
                                <tr>
                                    <th>Bill No</th>
                                    <th>Transaction No</th>
                                    <th>Reservation No</th>
                                    <th>Bill To</th>
                                    <th>Date</th>
                                    <th>remarks</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bills as $bill)
                                    <tr>
                                        <td>{{ $bill->bill_no }}</td>
                                        <td>{{ $bill->transaction_id }}</td>
                                        <td>{{ $bill->reservation->reservation_no }}</td>
                                        <td>{{ $bill->guest->name }}</td>
                                        <td>{{ $bill->bill_date }}</td>
                                        <td>{{ $bill->remarks }}</td>
                                        <td>
                                            {{-- <a href="{{ route('print-bill', ['id' => $bill->id]) }}">download</a> --}}
                                            <a href="{{ route('print-bill', ['id' => $bill->id]) }}" class="btn btn-sm btn-info py-1">Download</a>
                                            @if (!in_array($bill->id, $payments))
                                                <button class="open-popup btn btn-sm btn-success py-1" data-href="{{ route('payment-view', ['id' => $bill->id]) }}">Pay</button>
                                            @else 
                                                <span class="py-1 px-2 bg-secondary rounded text-light">paid</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <x-footer/>
            </div>
        </div>
    </div>
    {{-- popup --}}
    <x-popup/>

    <script>
    $(document).ready(function () {
        $('.print-bill').on('click', function () {
            var route = $(this).data('route');

            // Show loading message before AJAX request is sent
            Swal.fire('loading');

            $.ajax({
                url: route,
                type: "GET",
                success: function (response) {
                    // Hide loading message after successful response
                    Swal.close();

                    // Create a temporary anchor element to trigger the file download
                    // var a = document.createElement('a');
                    // a.href = window.URL.createObjectURL(new Blob([response]));
                    // a.download = 'demoBill.pdf'; // You can customize the file name here
                    // document.body.appendChild(a);
                    // a.click();
                    // document.body.removeChild(a);
                },
                error: function () {
                    Swal.fire('Error occurred while generating the PDF');
                }
            });
        });
    });

    </script>

<x-main-footer/>