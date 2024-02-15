<!-- resources/views/profile.blade.php -->

{{-- {{ dd($guest); }} --}}

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">

            @if(session('message'))
                <script>
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                    });
                    
                    Toast.fire({
                        icon: 'success',
                        title: 'Signed in successfully'
                    })
                </script>
            @endif
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
                <div class="row">
					<div class="col-md-6 m-auto grid-margin stretch-card">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">New Room Category</h4>
								<form id="newRoomForm">
                                    <div class="mb-3">
                                        <label for="roomCategory" class="form-label">Room Category</label>
                                        {{-- <select class="form-control" name="" id="">
                                            <option value="" selected disabled>--select--</option>
                                            <option value="vip">vip</option>
                                        </select> --}}
                                        <input id="roomCategory" class="form-control" name="roomCategory" type="text">
                                    </div>
                                    <div class="d-flex justify-content-end py-3">
                                        <button class="btn btn-success">Submit</button>
                                    </div>
                                </form>
                                
                            </div>
                        </div>
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
