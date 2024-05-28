
    <div class="pt-3" id="featureView">
        <div class="mb-3 mx-3">
            <p>Room Category : {{ $roomCategory->Category->name }}</p>
        </div>
        <div class="table-responsive px-3">
            <table id="example" class="table text-capitalize">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Remarks</th>
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

    <script>
    $(document).ready(function() {
        $('#example tbody tr td .add-feature').on('click', function() {
            
            const roomCategoryId = "{{ $roomCategory->id }}";
            const featureId = $(this).parent().parent().data('id');
            const name = $(this).parent().parent().find('.name').html();

            Swal.fire({
                title: "Do want the " + name + " feature in your {{ $roomCategory->Category->name }}?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Add"
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('add-new-room-feature') }}",
                        type: 'POST',
                        data: {
                            roomCategoryId:roomCategoryId,
                            featureId:featureId,
                        },
                        success: function (res) {
                            console.log(res);
                            if (res === 'done') {
                                Swal.fire({
                                    title: "Done!",
                                    text: "Feature has been added to the {{ $roomCategory->Category->name }}.",
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
        });

        $('#example tbody tr td .remove-feature').on('click', function() {
            console.log('remove');
            const roomCategoryId = "{{ $roomCategory->id }}";
            const featureId = $(this).parent().parent().data('id');
            const name = $(this).parent().parent().find('.name').html();

            Swal.fire({
                title: "Do want to remove the " + name + " feature from your {{ $roomCategory->Category->name }}?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Remove"
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('remove-room-feature') }}",
                        type: 'POST',
                        data: {
                            roomCategoryId:roomCategoryId,
                            featureId:featureId,
                        },
                        success: function (res) {
                            console.log(res);
                            if (res === 'done') {
                                Swal.fire({
                                    title: "Done!",
                                    text: "Feature has been removed from the {{ $roomCategory->Category->name }}.",
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
        });
    });
    </script>
