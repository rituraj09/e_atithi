<!-- resources/views/rooms/available.blade.php -->

<x-header/>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
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
                        <form action="" method="post" class="">
                            @csrf
                            <div class="auth-side-wrapper rounded-top">
                                <!--- Profile Pic --->
                                <img class="rounded" src="https://24.media.tumblr.com/b503240c9d865d1b2957f14a7726f7b8/tumblr_mmawh9gCIT1sps9zgo1_500.gif" alt="image" srcset=""
                                style="height: 200px; width: 100%; object-fit: cover;">
                            </div>
                            <div class="row">
                                <h5 class="text-muted fw-normal px-4 py-3">Available Guest House</h5>
                                <div class="auth-form-wrapper col-md-10 mx-auto py-3">
                                    <div class="row m-0">
                                        <div class="col-md-6 col-lg-4 p-2">
                                            <div class="card p-3 rounded-3 shadow">
                                                <div class="d-flex flex-column">
                                                    <img src="" alt="" class="w-100" height="100">
                                                    <div class="d-flex pt-3">
                                                        2 rooms availabel
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex my-4 justify-content-end">
                                        <button class="btn btn-primary rounded-3 px-4">
                                            Book
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

    <!-- core:js -->
    <script src="../../../assets/vendors/core/core.js"></script>
    <!-- endinject -->

    <!-- inject:js -->
    <script src="../../../assets/vendors/feather-icons/feather.min.js"></script>
    <script src="../../../assets/js/template.js"></script>
    <!-- endinject -->

    <!-- Custom js for this page -->
    
    <!-- End custom js for this page -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
      $(document).ready( () => {

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
                    <option value="${ops.name}"/>
                    `).join('');
                    resList.html(html);
                    // console.log(html)
                }
            })
        });
      });
    </script>

</body>

</html>
