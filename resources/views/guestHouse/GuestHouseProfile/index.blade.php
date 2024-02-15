<!-- resources/views/profile.blade.php -->

{{-- {{ dd($guest); }} --}}

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <x-alerts/>
            <nav class="sidebar">
                <div class="sidebar-header">
                  <a href="#" class="sidebar-brand">
                    <span>e</span>Atithi
                  </a>
                  <div class="sidebar-toggler not-active">
                    <span></span>
                    <span></span>
                    <span></span>
                  </div>
                </div>
                <x-sidebar/>
              </nav>
            <x-navbar/>

            <div class="page-content">
                <div class="row w-100 mx-0">
                    <div class="col-md-12 col-xl-12 mx-auto">
                        <form action="{{ route('update-guest-profile')}}" method="post" class="">
                            @csrf
                            <div class="auth-side-wrapper rounded-top">
                                <!--- Profile Pic --->
                                <img class="rounded" src="https://24.media.tumblr.com/b503240c9d865d1b2957f14a7726f7b8/tumblr_mmawh9gCIT1sps9zgo1_500.gif" alt="image" srcset=""
                                style="height: 200px; width: 100%; object-fit: cover;">
                            </div>
                            <div class="row">
                                <h5 class="text-muted fw-normal px-4 py-3">Profile Information</h5>
                                <div class="col-md-6 pe-md-0">
                                    <div class="auth-form-wrapper ps-md-5 py-3">
                                        <!-- Profile information goes here -->
                                        
                                        <div class="mb-3">
                                            <label class="form-label">Guest House Name:</label>
                                            <select class="form-control" name="guest_type" id="">
                                                
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Address:</label>
                                            <input 
                                                class="form-control" 
                                                type="text" name="nationality" id=""
                                                placeholder="nationality" 
                                                value="">
                                        </div>
                                        <!-- Add more profile fields as needed -->

                                        <!-- Edit Profile button -->
                                    </div>
                                </div>
                                <div class="col-md-6 ps-md-0">
                                    <div class="auth-form-wrapper px-md-5 py-md-3">
                                        <!-- Additional profile content goes here -->
                                        <div class="mb-3">
                                            <label class="form-label">Guest House Type:</label>
                                            <select class="form-control" name="gender" id="">
                                                
                                                {{-- @switch($guest->gender)
                                                
                                                    @default --}}
                                                        <option value="" 
                                                        {{-- @if ($guest->gender == NULL)
                                                            selected
                                                        @endif  --}}
                                                        disabled>--select--</option>
                                                {{-- @foreach ($genders as $gender)
                                                    <option value="{{ $gender->id }}" 
                                                    @if ($guest->gender == $gender->id )
                                                        selected
                                                    @endif 
                                                    >{{ $gender->name }}</option>
                                                @endforeach --}}
                                                        
                                                {{-- @endswitch --}}
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">ID Card Type:</label>
                                            <select class="form-control" name="id_card_type">
                                                {{-- {{ $guest->id_card_type }} --}}
                                            </select>
                                        </div>
                                        <!-- Add more fields as needed -->
                                    </div>
                                </div>
                                <div class="col-12 pb-3 pt-0 px-md-4 d-flex justify-content-end">
                                    <button type="submit" href="" class="btn btn-primary ms-auto me-0">Update Profile</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- core:js -->
    <script src="../../../assets/vendors/core/core.js"></script>
    <!-- endinject -->

    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->

    <!-- inject:js -->
    <script src="../../../assets/vendors/feather-icons/feather.min.js"></script>
    <script src="../../../assets/js/template.js"></script>
    <!-- endinject -->

    <!-- Custom js for this page -->
    <!-- End custom js for this page -->

</body>

</html>
