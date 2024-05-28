<div>
    <div class="col-md-8 mx-auto mb-3">
        <label class="fs-4 fw-bolder text-darkgray mb-3" for="">{{ $reservation->reservation_no }}</label>
        <div class="mb-3">Check-in Date :  {{ $reservation->check_in_date }} </div>
        <div class="mb-3">Check-out Date : {{ $reservation->check_out_date }} </div>
    </div>
    <hr>
    <form action="{{ route('update-reservation-room') }}" method="post">
        @csrf
        <input type="hidden" id="id" value="{{ $reservation->id }}">
        @foreach ($oldRooms as $index => $oldRoom)
            <div class="row col-md-8 mx-auto">
                <div class="col-md-6 mb-3">
                    <div class="fw-bolder mb-1">Current Room</div>
                    <input type="text" class="form-control" value="{{ $oldRoom->roomDetails->room_number }}" disabled readonly>  
                </div>
                <div class="col-md-6 mb-3">
                    <div class="fw-bolder mb-1">New Rooom</div>
                    <select name="new_room" id="{{ $index }}" class="form-control room-select">
                        {{-- <option value="{{ $oldRoom->roomDetails->id }}">{{ $oldRoom->roomDetails->room_number }}</option> --}}
                        
                    </select>
                </div>
            </div>   
        @endforeach
         
        <hr>  
        <div class="col-md-8 mx-auto mb-3">
            <div class="fw-bolder mb-1">Remarks</div>
            <textarea name="remarks" id="" cols="30" rows="2" class="form-control"></textarea>
        </div>
        <div class="col-md-8 mx-auto text-end">
            <button class="btn btn-success">Save</button>
        </div>
    </form>
</div>

{{-- remove selected rooms --}}
<script>
    $(document).ready(function(){
        var roomOptions = $(".room-select");
        var selected = [];
        var allRooms;

        $.ajax({
            url: "{{ route('changeable-rooms') }}",
            type: "POST",
            data: {
                id:$("#id").val(),
            },
            success: function(res) {
                // console.log(res);
                allRooms = res;
                refreshOptions();
            }
        })

        const refreshOptions = () => {
            let html = '<option value="" selected disabled>--select--</option>'; // Default option
            html += allRooms.map(room => {
                if (!selected.includes(room.id)) { // Check if the room ID is not in the selected array
                    return `<option value="${room.id}">${room.room_number}</option>`;
                }
                return ''; // Return an empty string for already selected rooms
            }).join('');
            // roomOptions.html(html);
            roomOptions.each(function() {
                $(this).html(html);
            });

        }


        $('select').on('change',function(e) {
            var selectedRoomId =  $(this).find("option:selected");
            selectedRoomId.attr('selected');
            selected.push(selectedRoomId.val());     // it pushes only selected
            console.log(selectedRoomId.val())

            setTimeout(() => {
                refreshOptions();
            }, 1000);
            

            // // Set the selected attribute for the selected option
            // $(this).find('option').removeAttr('selected'); // Remove selected attribute from all options
            // $(this).find('option[value="' + selectedRoomId + '"]').attr('selected', 'selected'); // Set selected attribute for the selected option
        });

    })

</script>
{{-- <script>
    $(document).ready(function() {
        var roomOptions = $('#room-options');

        @foreach ($rooms as $room)
                            <option value="{{ $room->id }}">{{ $room->room_number }}</option>
                        @endforeach

        roomOptions.html(``);


        var selected = [];
        var allRooms = [];
        $('.room-select option:not([value=""])').each(function() {
            allRooms.push($(this));     // it pushes all options
        });

        $('.room-select').change(function() {
            var selectedRoomId = $(this).val();
            $('.room-select').not(this).find('option').each(function() {
                if ($(this).val() === selectedRoomId) {
                    selected.push($(this));     // it pushes only selected

                }
            });
        });
    });
</script> --}}