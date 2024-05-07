<!-- resources/views/profile.blade.php -->

{{-- {{ dd($reservations); }} --}}

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-admin.navbar/>

            <div class="page-content">

                <x-page-header :title="'Manage Reservations'"/>
                <div class="d-flex flex-column border card">
                    <div class="d-flex col nav nav-tabs bg-light pt-2 px-2">
                        <div>
                            <a href="{{ route('all-reservations') }}" class="text-capitalize nav-link active px-4 fw-bold">
                                view
                            </a>
                        </div>
                        <div>
                            <a href="{{ route('create-reservation') }}" class="text-capitalize nav-link">
                                add
                            </a>
                        </div>
                    </div>
                    <div class="">
                        <div class="table-responsive">
                            <table id="example" class="table">
                                <thead>
                                    <tr>
                                    <th>Reservation No</th>
                                    <th>Guest Name</th>
                                    <th>Checkin/Checkout Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="">
                                    @foreach ($reservations as $reservation)
                                        <tr>
                                            <td>{{ $reservation->reservation_no }}</td>
                                            <td>{{ $reservation->guest->name }}</td>
                                            <td>
                                                <div>
                                                    <span>{{ $reservation->check_in_date }}</span>
                                                    <span class="mdi mdi-arrow-left-right mx-2"></span>
                                                    <span>{{ $reservation->check_out_date }}</span>
                                                </div> 
                                            </td>
                                            <td>{{ $reservation->getStatus->name }}</td>
                                            <td>
                                                <a href="{{ route('reservation-details', ['id' => $reservation->id ]) }}" class="btn btn-info btn-sm py-1">view</a>
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
    </div>



    <script>
    $(document).ready( function () {
        function reload () {
            var path = "{{ route('get-all-sub-users') }}"
            $.ajax({
                url: path,
                type: 'GET',
                success: function(res) {
                    console.log(res);
                    const html = res.map(data => `
                        <tr>
                            <td>${data.admin_name}</td>
                            <td>${data.roles[0].name || data.role}</td>
                            <td>${data.phone}</td>
                            <td>${data.email}</td>
                            <td>
                                <div class="d-flex py-0">
                                    <div class="px-1">
                                        <button class="btn btn-info btn-sm py-1 view-btn" data-id="${data.id}">
                                            view
                                        </button>
                                    </div>
                                    <div class="px-1">
                                        <button class="btn btn-success btn-sm py-1 approve-btn" data-id="${data.id}">
                                            Approve
                                        </button>
                                    </div>
                                    <div class="px-1">
                                        <button class="btn btn-danger btn-sm py-1 reject-btn" data-id="${data.id}">
                                            Reject
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>    
                    `).join('');
                    $("#List").html(html);
                }
            })
        }

        reload();
    });

    var deleteUrl = ""
    $(document).on('click', '.delete-btn', function() {
        const id = $(this).data('id');
        // Confirm deletion and send AJAX request to delete route
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert !",
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

    // Handle edit button click
    $(document).on('click', '.edit-btn', function() {
        const id = $(this).data('id');
        // Check if ID is valid before redirecting
        if (isNaN(id) || id <= 0) {
            console.error('Invalid category ID:', id);
            return;
        }
        // Redirect to the edit route with the ID
        const editRoute = "{{ route('edit-sub-user', ':id') }}"; // Replace with your actual route
        window.location.href = editRoute.replace(':id', id);
    });

    // $(document).ready(function(){
    //     $("#dataTableExample").DataTable({
    //         pageLength: 25,
    //         responsive: true,
    //         dom: '<"html5buttons"B>17fgitp',
    //         buttons: [
    //             {extend: 'copy'},
    //             {extend: 'csv'},
    //             {extend: 'excel', title: 'ExampleFile'},
    //             {extend: 'pdf', title: 'ExampleFile'},
    //             {extend: 'print',
    //                 customize: function (win){
    //                     $(win.document.body).addClass("white-bg"); 
    //                     $(win.document.body).css('font-size', '10px');
                    
    //                     $(win.document.body).find('table')
    //                     .addClass('compact')
    //                     .css("font-size", "inherit");
    //                 }
    //             }
    //         ],
    //     });
    // });    

    </script>

<x-main-footer/>