<!-- resources/views/guestHouse/GuestHouse/add.blade.php -->

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-admin.navbar/>

            <div class="page-content">
                <x-page-header :title="'Manage Room Features'"/>
                <div class="d-flex flex-column border card">
                    <div class="d-flex col nav nav-tabs bg-light pt-2 px-2">
                        <div>
                            <button id="roomButton" class="text-capitalize nav-link active px-4 fw-bold">
                                features
                            </button>
                        </div>
                        <div>
                            <a href="{{ route('add-guest-house-room-features') }}" class="text-capitalize nav-link">
                                Add
                            </a>
                        </div>
                    </div>
                    <div class="pt-3">
                        <div class="table-responsive px-3">
                            <table id="example" class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Remarks</th>
                                        <th>Action</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($features as $feature)
                                    {{-- {{ dd($guestHouse->country_name->name) }} --}}
                                        <tr>
                                            <td>{{ $feature->name }}</td>
                                            <td>{{ $feature->description }}</td>
                                            <td>{{ $feature->remarks }}</td>
                                            <td>
                                                <div class="d-flex py-0">
                                                    <a href="{{ route('edit-room-feature', ['id' => $feature->id]) }}" class="btn btn-sm btn-outline-primary">edit</a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check form-switch px-auto me-0">
                                                    <input type="checkbox" class="form-check-input" id="formSwitch1">
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
            <x-footer/>
        </div>
    </div>


    <script>
    $(document).ready(function() {
        $('.dropify-message p').css('font-size', '16px'); 
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
    });

    </script>

<x-main-footer/>
