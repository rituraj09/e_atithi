<!-- resources/views/profile.blade.php -->

{{-- {{ dd($guest); }} --}}

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-navbar/>

            <div class="page-content">
                <div class="row">
					<div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <x-page-header :title="'Manage Rooms'"/>
                                <div class="d-flex flex-column border border-dark">
                                    <div class="d-flex col nav nav-tabs bg-light pt-2 px-2">
                                        <div>
                                            <a href="{{ route('guest-house-admin-rooms') }}" class="nav-link active px-4 fw-bold">
                                                view
                                            </a>
                                        </div>
                                        <div>
                                            <a href="{{ route('guest-house-admin-add-room') }}" class="nav-link">
                                                add
                                            </a>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="dataTableExample" class="table">
                                            <thead>
                                                <tr>
                                                <th>Room Number</th>
                                                <th>Room Type</th>
                                                <th>Features</th>
                                                <th>Remarks</th>
                                                <th>Rate</th>
                                                <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                <td>R 101</td>
                                                <td>VIP</td>
                                                <td>Na</td>
                                                <td></td>
                                                <td>200.00/-</td>
                                                <td>
                                                    <div class="d-flex py-0">
                                                        <div class="px-1">
                                                            <button class="btn btn-danger btn-sm">
                                                                {{-- <i data-feather="trash"></i> --}}
                                                                Delete
                                                            </button>
                                                        </div>
                                                        <div class="px-1">
                                                            <button class="btn btn-primary btn-sm">
                                                                {{-- <i data-feather="edit"></i> --}}
                                                                Edit
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<x-main-footer/>
