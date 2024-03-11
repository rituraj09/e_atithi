<!-- resources/views/profile.blade.php -->

<x-header/>
<body>
    <div class="main-wrapper">
        <x-user-navbar/>
        <div class="page-wrapper full-page">
            <div class="page-content">
                <x-page-header :title="'Find Guest Houses'" />
                <div class="d-flex flex-column card border p-3">
                    <div class="d-flex align-items-center justify-content-center border border-light rounded-3 px-3">
                        <span class="mdi mdi-magnify fs-3 text-secondary"></span>
                            {{-- <i data-feather="search" class="text-secondary"></i> --}}
                        <input type="text" name="" id="" class="form-control border-0 text-secondary">
                    </div>

                    <div class="row m-0">
                        <div class="col-md-4">
                            location
                        </div>
                        <div class="col-md-2">
                            checkin
                        </div>
                        <div class="col-md-2">
                            checkout
                        </div>
                        <div class="col-md-3">
                            search
                        </div>
                    </div>
                </div>
                <div class="row w-100 mx-0">
                    <div class="col-md-12 col-xl-12 mx-auto">
                        <form action="{{ route('guest-house-search') }}" method="post" id="searchForm">
                            @csrf
                            <div class="auth-side-wrapper rounded-top">
                                <!--- Profile Pic --->
                                <img class="rounded" src="https://24.media.tumblr.com/b503240c9d865d1b2957f14a7726f7b8/tumblr_mmawh9gCIT1sps9zgo1_500.gif" alt="image" srcset=""
                                style="height: 200px; width: 100%; object-fit: cover;">
                            </div>
                            <div class="row">
                                <h5 class="text-muted fw-normal px-4 py-3">Guest House Booking</h5>
                                <div class="auth-form-wrapper col-md-8 mx-auto py-3">
                                    <!-- Profile information goes here -->
                                    {{-- <div class="row mb-3"> --}}
                                    <form action="{{ route('get-guest-houses') }}" method="get" class="">
                                        <div class="row mb-3">
                                            <label class="form-label col-md-4 m-auto fs-5">Guest House:</label>
                                            <div class="col-md-8">
                                                <div class="input-group">
                                                    <input 
                                                    class="form-control" 
                                                    type="text" name="guest_house" id="searchField"
                                                    placeholder="search" 
                                                    list="searchResult">
                                                    <span class="input-group-text bg-light rounde-end">
                                                        <i data-feather="search"></i>
                                                    </span>
                                                    <datalist id="searchResult">
                                                        <!--list body-->
                                                    </datalist>
                                                </div>
                                                {{-- <p id="searchResult"></p> --}}
                                            </div>
                                        </div>
                                    </form>
                                    <div class="row mb-3">
                                        <label class="form-label col-md-4 m-auto fs-5">Guest Type:</label>
                                        <div class="col-md-8">
                                            <select name="guest_type" id="" class="form-control">
                                                <option value="" selected disabled>--select--</option>
                                                <option value="govt employee">Govt Employee</option>
                                                <option value="official visit">Official Visit</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="form-label col-md-4 m-auto fs-5">Guest House Type:</label>
                                        <div class="col-md-8">
                                            <select name="guest_house_type" id="" class="form-control">
                                                <option value="" selected disabled>--select--</option>
                                                <option value="circuit house">Circuit House</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="form-label col-md-4 m-auto fs-5">Room Category:</label>
                                        <div class="col-md-8">
                                            <select name="room_type" id="" class="form-control">
                                                <option value="" selected disabled>--select--</option>
                                                <option value="standard">Standard Room</option>
                                                <option value="deluxe">Deluxe Room</option>
                                                <option value="suite">Suite</option>
                                                <option value="family">Family Room</option>
                                                <option value="penthouse">Penthouse</option>
                                            </select>
                                        </div>
                                    </div>                                    
                                    <div class="row mb-3" id="dashboardDate">
                                        <label class="form-label col-md-4 m-auto fs-5">Check-in date:</label>
                                        <div class="col-md-8">
                                            <input class="form-control" type="date" id="daterange" name="check-in" >
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label class="form-label col-md-4 m-auto fs-5">Check-out date:</label>
                                        <div class="col-md-8">
                                            <input class="form-control" type="date" id="daterange" name="check-out" >
                                        </div>
                                    </div>
                                    <div class="d-flex my-4 justify-content-end">
                                        <button class="btn btn-primary rounded-3 px-4" type="submit" id="searchGuestHouse">
                                            Search
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    /*  $(document).ready( () => {

        const path = "{{ route ('get-guest-houses')}}";
        let resList;

        $("#searchField").on('input', (e) => {

            e.preventDefault();
            const search = $("#searchField").val();
            resList = $("#searchResult");

            $.ajax({
                url: path,
                type: 'GET',
                data: {search:search},
                success: function (res) {
                    console.log(res);
                    const html = res.map(ops => `
                    <option value="${ops.name}">${ops.name}</option>
                    `).join('');
                    resList.html(html);
                    // console.log(html)
                }
            })
        });

        $("#room_plus").on("click", (e) => {
            e.preventDefault();
            const rooms = $("#no_of_rooms").val();
            $("#no_of_rooms").val(rooms);
        });
        $("#room_minus").on("click", (e) => {
            e.preventDefault();
            const rooms = $("#no_of_rooms").val();
            if ( rooms > 0) {
                $("#no_of_rooms").val(rooms);
            }
        });

        const mainPath = "{{ route('guest-house-search') }}"; */

        // $("#searchGuestHouse").on("click", (e) => {
        //     e.preventDefault();

        //     var formData = $("#searchForm").serialize();
        //     console.log(formData);

        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });

        //     $.ajax({
        //         url: mainPath,
        //         type: "POST",
        //         data: formData,  // Pass the serialized form data directly
        //         success: function (res) {
        //             console.log(res);
        //             // if (res.guestHouseId) {
        //             //     // Construct the redirect URL with query parameters
        //             //     var redirectUrl = '/rooms/' + res.guestHouseId +
        //             //         '?guestType=' + encodeURIComponent(res.guestType) +
        //             //         '&roomType=' + encodeURIComponent(res.roomType) +
        //             //         '&guestHouseType=' + encodeURIComponent(res.guestHouseType);

        //             //     // Redirect to another page with the constructed URL
        //             //     window.location.href = redirectUrl;
        //             // } else {
        //             //     console.log(res.message);
                        
        //             //     // Handle case where guest house is not found (display a message, etc.)
        //             // }
        //         },
        //         error: function (err) {
        //             console.log(err.responseText);
        //         }
        //     });
        // });

    //   }); 
    </script>

<x-main-footer/>
