<!-- resources/views/guestHouse/GuestHouse/view.blade.php -->

{{-- {{ dd($order); }} --}}

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-guest.guest-navbar/>

            <div class="page-content" style="background-color: #f1fcff">
                <x-page-header :prev="'My Orders'" :title="'Details'" />
                <div class="card row mb-2 p-3 text-capitalize">
                    <div class="mb-4 d-flex">
						
                    </div>
                    <div class="row m-0 mb-3">
                        <p class="fw-bold fs-4 mb-3">Reservation No: {{ $order->reservation_no }}</p>
                        <div class="mb-2">
                            <p>{{ $order->guestHouse->name }}, {{ $order->guestHouse->district_name->name }}</p>
                        </div>
                        <div class="mb-3">
                            <p>from {{ \Carbon\Carbon::parse($order->check_in_date)->format('d-m-Y') }} to {{ \Carbon\Carbon::parse($order->check_out_date)->format('d-m-Y') }}</p>
                        </div>
                    </div>
                    <div id="content">
                        <ul class="timeline">
                          <li class="event" data-date="12:30 - 1:00pm">
                            <h3 class="title">Registration</h3>
                            <p>Get here on time, it's first come first serve. Be late, get turned away.</p>
                          </li>
                          <li class="event" data-date="2:30 - 4:00pm">
                            <h3 class="title">Opening Ceremony</h3>
                            <p>Get ready for an exciting event, this will kick off in amazing fashion with MOP & Busta Rhymes as an opening show.</p>    
                          </li>
                          <li class="event" data-date="5:00 - 8:00pm">
                            <h3 class="title">Main Event</h3>
                            <p>This is where it all goes down. You will compete head to head with your friends and rivals. Get ready!</p>    
                          </li>
                          <li class="event" data-date="created_at time">
                            <h3 class="title">Reservation Status</h3>
                            <p>Reservation remarks.</p>    
                          </li>
                        </ul>
                      </div>
                </div>
                    
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
