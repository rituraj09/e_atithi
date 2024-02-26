<!-- resources/views/guestHouse/Rate/add.blade.php -->

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
                                <x-page-header :title="'Manage Room Rates'"/>
                                <div class="d-flex flex-column border border-dark">
                                    <div class="d-flex col nav nav-tabs bg-light pt-2 px-2">
                                        <div>
                                            <a href="{{ route('room-rates') }}" class="nav-link">
                                                view
                                            </a>
                                        </div>
                                        <div>
                                            <a href="{{ route('add-room-rate') }}" class="nav-link active px-4 fw-bold">
                                                add
                                            </a>
                                        </div>
                                    </div>
                                    <div class="pt-3">
                                        <form class="mx-2 mx-md-3 form" id="newRoomForm" action="{{ route('new-room-rate') }}" method="POST">
                                            @csrf
                                            <div class="row m-0 p-0">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Room Number</label>
                                                        <input id="name" class="form-control" name="name" type="text" placeholder="Guest house name">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="roomCategory" class="form-label">Room Category</label>
                                                        <select class="form-control" name="roomCategory" id="roomCategory">
                                                            <option value="" selected disabled>--select--</option>
                                                            @foreach ( $roomCategories as $roomCategory )
                                                                <option value="{{ $roomCategory->id }}">{{ $roomCategory->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="email" class="form-label">Official Email</label>
                                                        <input id="email" class="form-control" name="email" type="text" placeholder="Official email id">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="price" class="form-label">Rate</label>
                                                        <input id="price" class="form-control" name="rate" type="text" placeholder="Rate per night">
                                                    </div>
                                                </div>
                                                {{-- address --}}
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="address" class="form-label">Address</label>
                                                        <input id="address" class="form-control" name="address" type="text" placeholder="optional">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="pin" class="form-label">PIN</label>
                                                        <input id="phone" class="form-control" name="pin" type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="Pin no">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-end py-3">
                                                <button id="formSubmit" type="submit" class="btn btn-success">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom js for this page -->
    <script>
    $(document).ready( function () {

        // common csrf header
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        const deleteUrl = "{{ route('delete-room-category')}}";
        $(".ask-delete").on('click', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert !" + id,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: deleteUrl,
                        type: "POST",
                        data: {id:id},
                        success: function(res) {
                            console.log(res)
                        }
                    })
                    Swal.fire({
                    title: "Deleted!",
                    text: "id" + id,
                    icon: "success"
                    });
                }
            });
        });
    })
    </script>

<x-main-footer/>