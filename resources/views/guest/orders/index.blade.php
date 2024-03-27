<!-- resources/views/guestHouse/GuestHouse/view.blade.php -->

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-guest.guest-navbar/>

            <div class="page-content" style="background-color: #f1fcff">
                <x-page-header :title="'My Orders'" />
                @foreach ($orders as $order)
                    <div class="mb-2 card p-2">
                        {{ $order->guestHouse->name }}
                    {{ $order->reservation_no }}
                    {{ $order->guestHouse->district_name->name }}
                    {{ $order->created_at }}
                    {{ $order->getStatus->name }}
                    </div>
                @endforeach
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
