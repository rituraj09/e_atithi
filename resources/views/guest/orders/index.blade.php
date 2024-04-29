<!-- resources/views/guestHouse/GuestHouse/view.blade.php -->

{{-- {{ dd($orders); }} --}}

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-guest.guest-navbar/>

            <div class="page-content" style="background-color: #f1fcff">
                <x-page-header :title="'My Orders'" />
                {{-- @foreach ($orders as $order)
                    <div class="mb-2 card p-2">
                        {{ $order->guestHouse->name }}
                        {{ $order->reservation_no }}
                        {{ $order->guestHouse->district_name->name }}
                        {{ $order->created_at }}
                        {{ $order->getStatus->name }}
                    </div>
                @endforeach --}}
                <div class="card row mb-2 p-3">
                    <div class="mb-4 d-flex">
						<div class="input-group">
                            <div class="input-group-text">
                                <span class="mdi mdi-magnify fs-4"></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Search here...">
                        </div>
                        <div class="col p-2 ps-3 cursor">
                            <span class="mdi mdi-sort-reverse-variant fs-4"></span>
                        </div>
                    </div>
                    <div class="row mx-0">
                        @foreach ($orders as $order)
                        <div class="row mx-0 border rounded mb-2 p-2 text-capitalize cursor">
                            <p class="col-12 fw-bold fs-4 pb-1">Reservation No: {{ $order->reservation_no }}</p>
                            <div class="col-7 text-darkgray">
                                <p>{{ $order->guestHouse->name }}, {{ $order->guestHouse->district_name->name }}</p>
                                <p>from {{ \Carbon\Carbon::parse($order->check_in_date)->format('d-m-Y') }} to {{ \Carbon\Carbon::parse($order->check_out_date)->format('d-m-Y') }}</p>
                            </div>
                            <div class="col-4 text-darkgray text-end">
                                {{-- cancelled by guest --}}
                                @if ( $order->status === 2 )
                                    <p class="text-secondary"> 
                                {{-- rejected by guest house --}}
                                @elseif ( $order->status === 4 )
                                    <p class="text-danger">
                                {{-- others --}}
                                @elseif ( $order->status === 1 )
                                    <p class="text-warning">
                                @else
                                    <p class="text-success">
                                @endif
                                    {{ $order->getStatus->name }}
                                </p>
                                <p>{{ $order->charges_of_accomodation }}</p>
                            </div>
                            <div class="col-1 p-2 text-center">
                                <span class="mdi mdi-chevron-right text-primary fs-3"></span>
                            </div>
                        </div>
                        @endforeach
                        
                    </div>
                </div>
                    {{-- <div class="d-flex flex-column border card p-2">
                        <div class="responsive-table">
                            <table class="table" id="dataTableExample">
                                <tbody>
                                   @foreach ($orders as $order)
                                       <tr class="text-capitalize text-truncate">
                                            <td>{{ $order->guestHouse->name }}
                                            {{ $order->reservation_no }}
                                            {{ $order->guestHouse->district_name->name }}
                                            {{ $order->created_at }}
                                            {{ $order->getStatus->name }}
                                            </td>
                                       </tr>
                                   @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div> --}}
                    <x-footer/>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom js for this page -->
    <script>
    $(document).ready(function () {

    });
    </script>

<x-main-footer/>
