{{-- reservation cancellation part --}}
{{-- @if (!$order->cancellation_by_guest_date || !$order->hasTransactions || !$order->cancellation_by_admin_date) --}}
<div class="p-2 mt-4">
    <form action="{{ route('cancel-order') }}" method="post">
        @csrf
        <input type="hidden" name="reservation_id" value="{{ $id }}">
        <div class="row mb-2">
            <label class="form-label mb-2">Reason of cancellation</label>
            {{-- <div class="col-md-3">
                
            </div>
            <div class="col-md-9"> --}}
                <textarea class="form-control" name="cancellationReason" cols="30" rows="3" required></textarea>
            {{-- </div> --}}
            @error('cancellationReason')
                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-2 text-end">
            <button class="btn btn-warning">Submit</button>
        </div>
    </form>
</div>
{{-- @endif --}}