<!-- resources/views/profile.blade.php -->

{{-- {{ dd($rooms); }} --}}

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-admin.navbar/>

            <div class="page-content">
                <x-page-header :title="'Manage Rooms'"/>
                <div class="d-flex flex-column border card">
                    <div class="d-flex col nav nav-tabs bg-light pt-2 px-2">
                        <div>
                            <a href="{{ route('guest-house-admin-rooms') }}" class="text-capitalize nav-link active px-4 fw-bold">
                                view
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('guest-house-admin-add-room') }}" class="text-capitalize nav-link">
                                add
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive p-3">
                        <table id="example" class="table">
                            <thead>
                                <tr>
                                <th>Room Number</th>
                                <th>Room Type</th>
                                <th>General Rate</th>
                                <th>Govt Rate</th>
                                <th>Occupency</th>
                                <th>Status</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rooms as $room)
                                    <tr>
                                        <td>{{ $room->room_number }}</td>
                                        <td class="text-capitalize">
                                            {{ $room['roomCategory']['Category']->name }}, 
                                            {{ $room['bedType'][0]->name }}
                                        </td>
                                        <td>{{ $room->total_price }}</td>
                                        <td>{{ $room->total_govt_price }}</td>
                                        <td>{{ $room->capacity }}</td>
                                        <td>
                                            <select class="room-status form-control" name="" data-id="{{ $room->id }}">
                                                <option value="1"
                                                @if ( $room->is_active )
                                                    selected
                                                @endif
                                                >Active</option>
                                                <option value="0"
                                                @if ( !$room->is_active )
                                                    selected
                                                @endif
                                                >Blocked</option>
                                                {{-- <option value="" disabled>--select--</option>
                                                @foreach ($roomStatus as $status)
                                                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                                                @endforeach --}}
                                            </select>
                                        </td>
                                        <td>
                                            <div class="d-flex py-0">
                                                <div class="px-1">
                                                    {{-- <a href="{{ route('room-details', ['id' => $room->id]) }}" class="btn btn-info btn-sm">
                                                        View
                                                    </a> --}}
                                                    <button class="open-popup btn btn-info btn-sm" data-href="{{ route('room-details', ['id' => $room->id]) }}">view</button>
                                                </div>
                                                {{-- <div class="px-1">
                                                    <button class="open-popup btn btn-success btn-sm" data-href="{{ route('room-has-features', ['id' => $room->id]) }}">Features</button>
                                                </div> --}}
                                                <div class="px-1">
                                                    <button data-href="{{ route('guest-house-edit-room', ['id' => $room->id]) }}" class="open-popup btn btn-primary btn-sm">
                                                        Edit
                                                    </button>
                                                </div>
                                                {{-- <div class="px-1">
                                                    <button class="btn btn-danger btn-sm">
                                                        Delete
                                                    </button>
                                                </div> --}}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <x-popup/>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    // $(document).ready({

    // })
    const calculatePrice = () => {
        var total = 0;
        total = total + parseFloat($('#bedCategory').find(':selected').data('price')) + parseFloat($('#roomCategory').find(':selected').data('price')) + (parseFloat($('#price').val()) || 0);
        console.log(total);
        $('#total').html(total + '.00');
    }

    $(document).on('click','.room-status', function (e) {
        const status = $(this).val();
        const room_id = $(this).data("id");

        console.log(status);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{ route('update-room-status') }}",
            type: "POST",
            data: {
                status:status,
                room_id:room_id,
            },
            success: function(res) {
                if (res === "done") {
                    Swal.fire({
                        title: "Room status updated successfully.",
                        icon: "success",
                    });
                } else {
                    Swal.fire({
                        title: "Something went wrong!",
                        text: "Please try again later.",
                        icon: "error",
                    });
                }
            }
        })
    })
</script>

<x-main-footer/>
