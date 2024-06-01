<!-- resources/views/profile.blade.php -->

{{-- {{ dd($payments); }} --}}

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-admin.navbar/>
            <div class="page-content">
                <x-page-header :title="'Manage Payments'"/>
                <div class="d-flex flex-column border card">
                    <div class="d-flex col nav nav-tabs bg-light pt-2 px-2">
                        <div>
                            <a href="{{ route('all-reservations') }}" class="text-capitalize nav-link active px-4 fw-bold">
                                view
                            </a>
                        </div>
                    </div>
                    <div class="">
                        <div class="table-responsive">
                            <table id="example" class="table">
                                <thead>
                                    <tr>
                                        <th>Payment No</th>
                                        <th>Paid By</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payments as $payment)
                                        <tr>
                                            <td>{{ $payment->payment_no }}</td>
                                            <td>{{ $payment->guest->name }}</td>
                                            <td>{{ $payment->total_amount }}</td>
                                            <td>{{ $payment->transaction_time }}</td>
                                            <td>
                                                <a href="{{ route('print-bill', ['id' => $payment->bill_id]) }}" class="btn btn-sm btn-info py-1">Dwonload Bill</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-popup/>

<x-main-footer/>