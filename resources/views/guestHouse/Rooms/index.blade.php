<!-- resources/views/profile.blade.php -->

{{-- {{ dd($guest); }} --}}

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-navbar/>

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
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                <th>Room Number</th>
                                <th>Room Type</th>
                                <th>Rate</th>
                                <th>Occupency</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rooms as $room)
                                    <tr>
                                        <td>{{ $room->room_number }}</td>
                                        <td class="text-capitalize">
                                            {{ $room['roomRate']->name }}, 
                                            {{ $room['roomRate']['roomCategory']->name }}
                                        </td>
                                        <td>{{ $room['roomRate']->price }}</td>
                                        <td>{{ $room->capacity }}</td>
                                        <td>
                                            <div class="d-flex py-0">
                                                <div class="px-1">
                                                    <a href="{{ route('room-details', ['id' => $room->id]) }}" class="btn btn-info btn-sm">
                                                        {{-- <i data-feather="trash"></i> --}}
                                                        View
                                                    </a>
                                                </div>
                                                <div class="px-1">
                                                    <a href="{{ route('guest-house-edit-room', ['id' => $room->id]) }}" class="btn btn-primary btn-sm">
                                                        {{-- <i data-feather="edit"></i --}}
                                                        Edit
                                                    </a>
                                                </div>
                                                <div class="px-1">
                                                    <button class="btn btn-danger btn-sm">
                                                        {{-- <i data-feather="trash"></i> --}}
                                                        Delete
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    // $(document).ready({

    // })
</script>

<x-main-footer/>
