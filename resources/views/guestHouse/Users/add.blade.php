<!-- resources/views/guestHouse/Users/add.blade.php -->

{{-- {{ dd(auth()->user()); }} --}}

<x-header/>
<body>
  <div class="main-wrapper">
    <div class="page-wrapper">
        <x-navbar/>

            <div class="page-content">
                <x-page-header :prev="'Manage Users'" :title="'Add'" />
                <div class="d-flex flex-column border card">
                    <div class="d-flex col nav nav-tabs bg-light pt-2 px-2">
                      <div>
                          <a href="{{ route('all-sub-users') }}" class="nav-link">
                              view
                          </a>
                      </div>
                      <div>
                          <a href="{{ route('add-sub-users') }}" class="nav-link active px-4 fw-bold">
                              add
                          </a>
                      </div>
                    </div>
                    <div class="pt-3">
                      <form class="mx-2 mx-md-3 d-flex flex-column flex-md-row-reverse forms-sample" action="{{ route('new-sub-user') }}" method="post">
                        @csrf
                        {{-- user profile --}}
                        <div class="col-md-4 col-lg-3 px-3">
                          <div class="mb-3">
                              <div class="mx-auto">
                                  {{-- <p class="text-muted mb-3">Read the <a href="https://github.com/JeremyFagis/dropify" target="_blank"> Official Dropify Documentation </a>for a full list of instructions and other options.</p> --}}
                                  <input type="file" id="myDropify"/>
                                  <h6 class="form-label pt-3">Profile Picture</h6>
                              </div>
                          </div>
                        </div>
                        {{-- user data --}}
                        <div class="col-md-8 col-lg-9">
                          <div class="row mb-3">
                            <label for="fullname" class="form-label col-md-4 m-auto">Full name</label>
                            <div class="col-md-8">
                              <input type="text" class="form-control" id="fullname" autocomplete="Username" name="fullname" placeholder="full name" required>
                            </div>
                            
                          </div>
                          <div class="row mb-2">
                            <label for="phone" class="form-label col-md-4 m-auto">Phone no.</label>
                            <div class="col-md-8">
                              <input type="text" class="form-control" id="phone" name="phone" placeholder="+91" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
                            </div>
                            
                          </div>
                          <div class="row mb-3">
                            <label for="phone-otp" class="form-label col-md-4 m-auto">OTP for phone</label>
                            <div class="col-md-8">
                              <div class="input-group">
                                <input type="text" id="phone-otp" class="form-control" placeholder="OTP sent to phone number">
                                <button class="btn btn-success">verify</button>
                              </div>
                            </div>
                          </div>
                          <div class="row mb-2">
                            <label for="email" class="form-label col-md-4 m-auto">Email address</label>
                            <div class="col-md-8">
                              <input type="email" class="form-control" id="email" name="email" placeholder="Email address" required>
                            </div>
                          </div>
                          {{-- email-otp --}}
                          <div class="row mb-3">
                            <label for="email-otp" class="form-label col-md-4 m-auto">OTP for email</label>
                            <div class="col-md-8">
                              <div class="input-group">
                                <input type="text" id="email-otp" class="form-control" placeholder="OTP sent to email address"/>
                                <button type="button" class="btn btn-success">verify</button>
                              </div>
                            </div>
                          </div>
                          <div class="row mb-2">
                            <label for="captcha" class="form-label col-md-4 m-auto">Captcha</label>
                            <div class="col-md-8">
                                <img class="rounded-3" src="{{ route('captcha') }}" alt="Captcha Image">
                                <button class="ms-3 btn btn-sm btn-outline-primary"><i class="me-2 icon-md" data-feather="repeat"></i>reload</button>
                            </div>
                          </div>
                          <div class="row mb-3">
                            <div class="col-md-4"></div>
                            <div class="col-md-8">
                              <div class="input-group">
                                <input type="text" name="captcha" id="" class="form-control" placeholder="Type captcha here" required>
                                <button class="btn btn-success">verify</button>
                              </div>
                            </div>
                          </div>
                          {{-- role --}}
                          <div class="row mb-3">
                            <label for="role" class="form-label col-md-4 m-auto">User/Employee type</label>
                            <div class="col-md-8">
                                <select name="role" id="role" class="form-control" required>
                                    <option value="" selected disabled>--select--</option>
                                    @foreach ($roles as $role)
                                      <option value="{{ $role->id }}">{{ $role->name}}</option>
                                    @endforeach
                                </select>
                              </div>
                            </div>
                            @if (auth()->user()->roles[0]->name === 'super admin')
                            <div class="row mb-3">
                              <label for="role" class="form-label col-md-4 m-auto">Guest House</label>
                              <div class="col-md-8">
                                  <select name="guestHouse" id="guestHouse" class="form-control" required>
                                      <option value="" selected disabled>--select--</option>
                                      @foreach ($guestHouses as $guestHouse)
                                        <option value="{{ $guestHouse->id }}">
                                          {{ $guestHouse->name}} || {{ $guestHouse->district_name->name }}, {{ $guestHouse->state_name->name }}, {{ $guestHouse->country_name->name }}
                                      </option>
                                      @endforeach
                                  </select>
                              </div>
                            </div>
                            @endif
                            <div class="row mb-3">
                              <label for="userPassword" class="form-label col-md-4 m-auto">Password</label>
                              <div class="col-md-8">
                                  <div class="input-group">
                                      <input type="password" class="form-control" id="userPassword" name="password" autocomplete="current-password" placeholder="Password" required>
                                      <button class="btn btn-success">generate</button>
                                  </div>
                                </div>
                            </div>
                            <div class="mb-3">
                              <button type="submit" class="btn btn-primary text-white me-2 mb-2 mb-md-0">Register</button>
                            </div>
                          </div>
                          
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function () {
      $('.dropify-message p').css('font-size', '16px'); 
      $(".dropify-wrapper").css({'max-width':'100px !important'});
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
                                        <button class="btn btn-danger btn-sm py-1 delete-btn" data-id="${data.id}">
                                            Delete
                                        </button>
                                    </div>
                                    <div class="px-1">
                                        <button class="btn btn-primary btn-sm py-1 edit-btn" data-id="${data.id}">
                                            Edit
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>    
                    `).join('');
                    $("#userList").html(html);
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
    </script>

<x-main-footer/>
