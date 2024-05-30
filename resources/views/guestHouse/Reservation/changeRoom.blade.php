<div>
    <div class="col-md-8 mx-auto mb-3">
        <label class="fs-4 fw-bolder text-darkgray mb-3" for="">{{ $reservation->reservation_no }}</label>
        <div class="mb-3">Check-in Date :  {{ $reservation->check_in_date }} </div>
        <div class="mb-3">Check-out Date : {{ $reservation->check_out_date }} </div>
    </div>
    <hr>
    <form action="{{ route('update-reservation-room') }}" method="post">
        @csrf
        <input type="hidden" name="reservation_id" id="id" value="{{ $reservation->id }}">
        <input type="hidden" name="num_rooms" value="{{ count($oldRooms) }}">
        @foreach ($oldRooms as $index => $oldRoom)
            <div class="row col-md-8 mx-auto">
                <div class="col-md-6 mb-3">
                    <div class="fw-bolder mb-1">Current Room</div>
                    <input type="text" class="form-control" value="{{ $oldRoom->roomDetails->room_number }}" disabled readonly>  
                </div>
                <div class="col-md-6 mb-3">
                    <div class="fw-bolder mb-1">New Room </div>
                    <select name="new_room_{{$oldRoom->roomDetails->room_number}}" id="{{$index}}" class="form-control room-select">
                        <option value="" selected disabled>--select--</option>
                        @foreach ($rooms as $room)
                            <option value="{{ $room->id }}">{{ $room->room_number }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endforeach
         
        <div class="d-none p-2 col-md-7 mx-auto bg-warning bg-opacity-25 text-danger text-center" id="room-warning">
            This room is already selected in another dropdown!
        </div>
        <hr>  
        <div class="col-md-8 mx-auto mb-3">
            <div class="fw-bolder mb-1">Remarks</div>
            <textarea name="remarks" id="" cols="30" rows="2" class="form-control"></textarea>
        </div>
        <div class="col-md-8 mx-auto text-end">
            <button type="submit" class="btn btn-success">Save</button>
        </div>
    </form>
</div>

{{-- remove selected rooms --}}
<script>

    $(document).ready(function() {
    const selectedRooms = {}; // Object to store selected room IDs

        $('.room-select').on('change', function() {
            const currentSelect = $(this);
            const selectedRoomId = currentSelect.val();

            // Check if the selected room is already present in the object
            if (selectedRoomId && selectedRooms[selectedRoomId]) {
                // alert('This room is already selected in another dropdown!');
                $("#room-warning").removeClass('d-none');
                currentSelect.val(''); // Reset the current selection to avoid form submission
            } else {
                // Update the selectedRooms object with the new selection
                selectedRooms[selectedRoomId] = true;
                $("#room-warning").addClass('d-none');
            }
        });
    });

    // $(document).ready(function() {
    //     $('.room-select').on('change', function() {
    //         const selectedRoom = $(this).val();

            // Re-enable the previously selected room option in all select tags
            // $('.room-select').each(function() {
            //     const $select = $(this);
            //     const previouslySelectedRoom = $select.data('previously-selected-room');

            //     if (previouslySelectedRoom && previouslySelectedRoom !== selectedRoom) {
            //         $select.find(`option[value="${previouslySelectedRoom}"]`).prop('disabled', false);
            //     }

            //     // Store the currently selected room as the previously selected room
            //     $select.data('previously-selected-room', selectedRoom);

            //     // Disable the selected room option in all other select tags
            //     if (previouslySelectedRoom !== selectedRoom) {
            //         $select.find(`option[value="${selectedRoom}"]`).prop('disabled', true);
            //     }
            // });
    //     });
    // });

</script>
