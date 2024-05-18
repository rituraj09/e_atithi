<div class="row p-3">
    <div class="col-md-8 mx-auto">
        <form action="{{ route('update-reservation') }}" method="post">
        @csrf
            <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
            {{-- <input type="hidden" name="reservation_id" value="{{ $bill->reservation->id }}">
            <input type="hidden" name="transaction_id" value="{{ $bill->transaction_id }}">
            <input type="hidden" name="guest_house_id" value="{{ $bill->guest_house_id }}">
            <input type="hidden" name="guest_id" value="{{ $bill->bill_to }}">
            <input type="hidden" name="bill_id" value="{{ $bill->id }}"> --}}
            {{-- <span>{{ $reservation }}</span> --}}
            <div class="mb-3">
                <p class="text-darkgray mb-2">Reservation</p>
                <p class="fs-4 fw-bold ">{{ $reservation->reservation_no }}</p>
            </div>
            <hr>
            <div class="row mb-3">
                <div class="col-md-4 mb-2">
                    Check In Date
                </div>
                <div class="col-md-8 mb-2">
                    <input type="date" class="form-control" name="check_in_date" value="{{ $reservation->check_in_date }}">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4 mb-2">
                    Check Out Date
                </div>
                <div class="col-md-8 mb-2">
                    <input type="date" class="form-control" name="check_out_date" value="{{ $reservation->check_out_date }}">
                </div>
            </div>
            <div class="mb-3 text-end">
                <button type="submit" class="btn btn-success px-4">
                    Save changes
                </button>
            </div>
        </form>
    </div>
</div>