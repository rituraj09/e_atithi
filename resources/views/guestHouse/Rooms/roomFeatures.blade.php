<!-- resources/views/guestHouse/GuestHouse/add.blade.php -->

{{-- {{ dd($roomFeatures); }} --}}

{{-- <x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-admin.navbar/>

            <div class="page-content">
                <x-page-header :prev="'Manage Rooms'" :title="'view'"/>
                <div class="d-flex flex-column border card">
                    <div class="d-flex col nav nav-tabs bg-light pt-2 px-2">
                        <div>
                            <a href="{{ route('room-details', ['id' => $room->id]) }}" class="text-capitalize nav-link ">
                                details
                            </a>
                        </div>
                        <div>
                            <button id="featureButton" class="text-capitalize nav-link active px-4 fw-bold">
                                features
                            </button>
                        </div> 
                    </div> --}}
                    <div class="pt-3" id="featureView">
                        <div class="mb-3 mx-3">
                            <p>Room Number : {{ $room->room_number }}</p>
                            <p>Room Category : {{ $room->roomCategory->name }}, {{ $room->bedType[0]->name }}</p>
                            <p>Room Rate : {{ $room->total_price }}/-</p>
                        </div>
                        <div class="table-responsive px-3">
                            <table id="example" class="table text-capitalize">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Remarks</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($features as $feature)
                                    {{-- {{ dd($guestHouse->country_name->name) }} --}}
                                        <tr data-id="{{ $feature->id }}">
                                            <td class="name">{{ $feature->name }}</td>
                                            <td>{{ $feature->description }}</td>
                                            <td>{{ $feature->remarks }}</td>
                                            <td>{{ $feature->price }}</td>
                                            <td>
                                                @if (in_array($feature->id, $roomFeatures))
                                                    added
                                                @else
                                                    _
                                                @endif
                                            </td>
                                            <td>
                                                @if (in_array($feature->id, $roomFeatures))
                                                    <button class="btn btn-sm btn-danger remove-feature">Remove</button>
                                                @else
                                                    <button class="btn btn-sm btn-primary add-feature">Add</button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-none mx-2 mx-md-3">
                            <div class="d-flex justify-content-between p-3">
                                <h5 class="text-secondary">Employees</h5>
                            </div>
                            <div class="d-flex justify-content-end py-3">
                                <a href="{{ route('add-sub-users') }}" class="btn btn-sm btn-outline-primary">
                                    Add employee
                                </a>
                                {{-- <button id="formSubmit" disabled type="submit" class="btn btn-success">Save changes</button> --}}
                            </div>
                        </div>
                    </div>
                {{-- </div>
            </div>
            <x-footer/>
        </div>
    </div> --}}

    <script>
    $(document).ready(function() {
        $('#example tbody tr td .add-feature').on('click', function() {
            
            const roomId = "{{ $room->id }}";
            const featureId = $(this).parent().parent().data('id');
            const name = $(this).parent().parent().find('.name').html();
            // console.log(name);
            // console.log(roomId)

            Swal.fire({
                title: "Do want the " + name + " feature in your room {{ $room->room_number }}?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Add"
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('add-new-room-feature') }}",
                        type: 'POST',
                        data: {
                            roomId:roomId,
                            featureId:featureId,
                        },
                        success: function (res) {
                            console.log(res);
                            if (res === 'done') {
                                Swal.fire({
                                    title: "Done!",
                                    text: "Feature has been added to the room {{ $room->room_number }}.",
                                    icon: "success"
                                });
                            } else {
                                Swal.fire({
                                    title: "Failed!",
                                    text: "Something is wrong. Please try again.",
                                    icon: "error"
                                });
                            }
                        }
                    })
                }
            });
            // toggleRowSelection(this);
        });

        $('#example tbody tr td .remove-feature').on('click', function() {
            console.log('remove');
            // toggleRowSelection(this);
        });
    });
    </script>

   
{{-- <x-main-footer/> --}}
