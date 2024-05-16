<div class="row p-3">
    <div class="col-md-8 mx-auto">
        <form action="{{ route('pay-bill') }}" method="post">
        @csrf
            <input type="hidden" name="amount" value="{{ $bill->amount }}">
            <input type="hidden" name="reservation_id" value="{{ $bill->reservation->id }}">
            <input type="hidden" name="transaction_id" value="{{ $bill->transaction_id }}">
            <input type="hidden" name="guest_house_id" value="{{ $bill->guest_house_id }}">
            <input type="hidden" name="guest_id" value="{{ $bill->bill_to }}">
            <input type="hidden" name="bill_id" value="{{ $bill->id }}">
            <div class="mb-3 bg-light p-3 rounded">
                <p class="fs-4 fw-bold">Old Guest House</p>
                <p>Golaghat, Assam</p>
                <hr>
                <small>Staying</small>
                <p>{{ $bill->reservation->check_in_date }} - {{ $bill->reservation->check_out_date }}</p>
            </div>
            <hr>
            <div class="mb-3 bg-light p-3 rounded">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Room Number</th>
                            <th>Category</th>
                            <th>Nights</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hasTransactions as $transaction)
                            <tr>
                                <td>{{ $transaction->reservedRooms->roomDetails->room_number }}</td>
                                <td>{{ $transaction->reservedRooms->roomDetails->roomCategory->category->name }}</td>
                                <td>{{ $transaction->days }}</td>
                                <td>{{ $transaction->totalCost }}/-</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- <span>{{ $bill }}</span> --}}
            <div class="mb-2 d-flex px-4">
                <p class="col">Amount</p>
                <p class="col text-end">{{ $bill->amount }}.00/-</p>
            </div>
            <hr>
            <div class="mb-3 text-end">
                <button type="submit" class="btn btn-success px-4">
                    Pay
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // $(document).ready( function () {
    //     $('#pay').on('click', function () {
    //         Swal.fire({
    //             title: "Are you sure?",
    //             text: "You won't be able to revert this!",
    //             icon: "warning",
    //             showCancelButton: true,
    //             confirmButtonColor: "#3085d6",
    //             cancelButtonColor: "#d33",
    //             confirmButtonText: "Pay"
    //             }).then((result) => {
    //                 if (result.isConfirmed) {
    //                     Swal.fire({
    //                         title: "Deleted!",
    //                         text: "Your file has been deleted.",
    //                         icon: "success"
    //                     });
    //                 }
    //         });
    //     });
    // });
</script>