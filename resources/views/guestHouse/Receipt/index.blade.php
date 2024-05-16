<!-- resources/views/guestHouse/Transaction/index.blade.php -->

{{-- {{ dd($roomTransactions); }} --}}

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-admin.navbar/>

            <div class="page-content">
                <x-page-header :title="'Manage Receipts'"/>
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
                                    <th>Receipt No</th>
                                    <th>Transaction No</th>
                                    <th>Reservation No</th>
                                    <th>Receipt To</th>
                                    <th>Date</th>
                                    <th>remarks</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($receipts as $receipt)
                                    <tr>
                                        <td>{{ $receipt->receipt_no }}</td>
                                        <td>{{ $receipt->transaction_id }}</td>
                                        <td>{{ $receipt->reservation->reservation_no }}</td>
                                        <td>{{ $receipt->guest->name }}</td>
                                        <td>{{ $receipt->receipt_date }}</td>
                                        <td>{{ $receipt->remarks }}</td>
                                        
                                        <td>
                                            <button class="btn btn-sm btn-info py-1">Dwonload</button>
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

<x-main-footer/>