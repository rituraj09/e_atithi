<!-- resources/views/guestHouse/GuestHouse/view.blade.php -->

{{-- {{ dd($order->hasTransactions[0]->reservedRooms->roomDetails->room_number); }} --}}
{{-- {{ dd($order->hasTransactions); }} --}}

<x-header />

<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-guest.guest-navbar />

            <div class="page-content" style="background-color: #f1fcff">
                <x-page-header :prev="'My Orders'" :title="'Details'" />
                <div class="card row mb-2 p-3">
                    <div class="mb-4 d-flex">

                    </div>
                    <div class="row m-0 mb-3 col-md-10 mx-auto text-capitalize">
                        <p class="fw-bold fs-4 mb-3">Reservation No: {{ $order->reservation_no }}</p>
                        <div class="mb-2">
                            <p>{{ $order->guestHouse->name }}, {{ $order->guestHouse->district_name->name }}</p>
                        </div>
                        <div class="mb-3">
                            <p>from {{ \Carbon\Carbon::parse($order->check_in_date)->format('d-m-Y') }} to
                                {{ \Carbon\Carbon::parse($order->check_out_date)->format('d-m-Y') }}</p>
                        </div>
                    </div>
                    <div id="content">
                        <ul class="timeline">

                            <li class="event" data-date="{{ \Carbon\Carbon::parse($order->request_date)->format('h:m A, d M, Y') }}">
                                <h3 class="title">Reservation requested</h3>
                                <p>Reservation request by you.</p>
                            </li>
                            {{-- cancel before approval --}}
                            @if ($order->cancellation_by_guest_date && !$order->approval_date)
                                <li class="event"
                                    data-date="{{ \Carbon\Carbon::parse($order->cancellation_by_guest_date)->format('h:m A, d M, Y') }}">
                                    <h3 class="title">Reservation cancelled</h3>
                                    <p>Reservation cancelled by you.</p>
                                </li>
                            @endif
                            {{-- cancel before approval --}}
                            @if ($order->cancellation_by_admin_date && !$order->approval_date)
                                <li class="event"
                                    data-date="{{ \Carbon\Carbon::parse($order->cancellation_by_admin_date)->format('h:m A, d M, Y') }}">
                                    <h3 class="title">Reservation cancelled</h3>
                                    <p>Reservation cancelled by admin.</p>
                                </li>
                            @endif
                            {{-- approval --}}
                            @if ($order->approval_date)
                                <li class="event"
                                    data-date="{{ \Carbon\Carbon::parse($order->approval_date)->format('h:m A, d M, Y') }}">
                                    <h3 class="title">Reservation approved</h3>
                                    <p>Reservation approved by admin.</p>
                                </li>
                            @endif
                            {{-- cancel after approval --}}
                            @if ($order->cancellation_by_guest_date && $order->approval_date)
                                <li class="event"
                                    data-date="{{ \Carbon\Carbon::parse($order->cancellation_by_guest_date)->format('h:m A, d M, Y') }}">
                                    <h3 class="title">Reservation cancelled</h3>
                                    <p>Reservation cancelled by you.</p>
                                </li>
                            @endif
                            {{-- cancel after approval --}}
                            @if ($order->cancellation_by_admin_date && $order->approval_date)
                                <li class="event"
                                    data-date="{{ \Carbon\Carbon::parse($order->cancellation_by_admin_date)->format('h:m A, d M, Y') }}">
                                    <h3 class="title">Reservation cancelled</h3>
                                    <p>Reservation cancelled by admin.</p>
                                </li>
                            @endif

                            {{-- room check-in check-out part --}}
                            @foreach ($order->hasTransactions as $orderTransaction)
                                <li class="event"
                                    data-date="
										{{ \Carbon\Carbon::parse($orderTransaction->checked_in_time)->format('h:m A,') }} 
										{{ \Carbon\Carbon::parse($orderTransaction->checked_in_date)->format('d M, Y') }}
									">
                                    <h3 class="title">Rooms checked in</h3>
                                    <p>Room number {{ $orderTransaction->reservedRooms->roomDetails->room_number }} has been checked in by you.</p>
                                </li>
                                @if ($orderTransaction->checked_out_time)
									<li class="event"
										data-date="
											{{ \Carbon\Carbon::parse($orderTransaction->checked_out_time)->format('h:m A,') }} 
											{{ \Carbon\Carbon::parse($orderTransaction->checked_out_date)->format('d M, Y') }}
										">
                                        <h3 class="title">Rooms checked out</h3>
                                        <p>Room number {{ $orderTransaction->reservedRooms->roomDetails->room_number }} has been checked out by you.</p>
                                    </li>
                                @endif
                                @if ($order->status === 10)
                                    <li class="event"
                                        data-date="
                                            {{ \Carbon\Carbon::parse($orderTransaction->checked_out_time)->format('h:m A,') }} 
                                            {{ \Carbon\Carbon::parse($orderTransaction->checked_out_date)->format('d M, Y') }}
                                        ">
                                        
                                        <div class="row">
                                            <h3 class="title col-8">Bills generated</h3>
                                            @foreach ($receipts as $receipt)
                                                @if($receipt->transaction_id === $order->transaction_id)
                                                    <div class="col-4 mb-1 text-end">
                                                        <a href="{{ route('print-receipt', ['id' => $receipt->id]) }}" class="btn btn-sm py-1 btn-light">Receipt</a>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <p>Bill has been generated for the room {{ $orderTransaction->reservedRooms->roomDetails->room_number }}.</p>
                                        
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>

                    {{-- reservation cancellation part --}}
                    <div class="col-md-7 mx-auto p-2 mt-4 border-top pt-4 row">
                        @if ( $order->status === 1 )
                        <div class="mb-2 col">
                            <button class="btn btn-primary open-popup" data-href="{{ route('modify-order', ['id' => $order->id]) }}">Modify Reservation</button>
                        </div>
                        @endif
                        @if (($order->cancellation_by_guest_date === NULL && $order->cancellation_by_admin_date === NULL) && $order->hasTransactions === NULL)
                            <div class="mb-2 text-end col">
                                <button class="btn btn-warning open-popup" data-href="{{ route('order-cancellation', ['id' => $order->id]) }}">Cancel reservation</button>
                            </div>
                        @endif
                        @if ($order->status === 10)
                            @foreach ($receipts as $receipt)
                                @if($receipt->transaction_id === $order->transaction_id)
                                <div class="mb-2 text-end">
                                    <a href="{{ route('print-receipt', ['id' => $receipt->id]) }}" class="btn btn-info">download receipt</a>
                                </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
                <x-footer />
            </div>
            <x-popup/>
        </div>
    </div>
    </div>
<x-main-footer />
