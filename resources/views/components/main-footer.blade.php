<!-- core:js -->
<script src="{{ asset('assets/vendors/core/core.js') }}"></script>
<!-- endinject -->

<!-- Plugin js for this page -->
<script src="{{ asset('assets/vendors/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/vendors/dropify/dist/dropify.min.js') }}"></script>
<script src="{{ asset('assets/js/dropify.js') }}"></script>
<script src="{{ asset('js/jquery-ui.js') }}"></script>
<script src="{{ asset('assets/js/data-table.js') }}"></script>
<script src="{{ asset('/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js') }}"></script>
<script src="{{ asset('/assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
<!-- End plugin js for this page -->

<!-- inject:js -->
<script src="{{ asset('assets/vendors/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('assets/js/template.js') }}"></script>
<!-- endinject -->

<!-- Custom js for this page -->
<script src="{{ asset('assets/js/dashboard-light.js') }}"></script>
<!-- End custom js for this page -->

<script>
    $(document).ready(function() {
        $('.dropify-message p').css('font-size', '16px');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // country
        $("#country").on('change', function () {
            const c_id = $("#country").val();
            console.log(c_id);

            const stateurl = "{{ route('get-states', ['cid' => ':cid']) }}".replace(':cid', c_id);
            $.ajax({
                url: stateurl,
                type: 'GET',
                success: function (res) {
                    let html = '<option value="" selected disabled>--select--</option>'; // Default option
                    html += res.map(state => `<option value="${state.id}" >${state.name}</option>`).join('');
                    $("#state").html(html);
                }
            })
        });

        // district
        $("#state").on('change', function () {
            const s_id = $("#state").val();
            console.log(s_id);

            const districturl = "{{ route('get-districts', ['sid' => ':sid']) }}".replace(':sid', s_id);
            $.ajax({
                url: districturl,
                type: 'GET',
                success: function (res) {
                    let html = '<option value="" selected disabled>--select--</option>'; // Default option
                    html += res.map(state => `<option value="${state.id}" >${state.name}</option>`).join('');
                    $("#district").html(html);
                }
            })
        });

        $("#price").on("input", function() {
            // Regular expression to allow only numbers, optional decimal point, and up to 2 decimal places
            const regex = /^\d+(\.\d{0,2})?$/;

            // Check if the entered value matches the regular expression
            const isValid = regex.test($(this).val());

            // Set error message and style based on validity
            if (isValid) {
                $(this).removeClass("error");
                $(this).siblings(".error-message").remove(); // Remove existing error message if present
            } else {
                $(this).addClass("error");
                $(this).siblings(".error-message").remove();
                // Add error message next to the input field
                $(this).after("<span class='error-message text-danger'><small>Please enter a valid price. Format: 0.00<small/></span>");
            }
        });

        $(".price").on("input", function() {
            // Regular expression to allow only numbers, optional decimal point, and up to 2 decimal places
            const regex = /^\d+(\.\d{0,2})?$/;

            // Check if the entered value matches the regular expression
            const isValid = regex.test($(this).val());

            // Set error message and style based on validity
            if (isValid) {
                $(this).removeClass("error");
                $(this).siblings(".error-message").remove(); // Remove existing error message if present
            } else {
                $(this).addClass("error");
                $(this).siblings(".error-message").remove();
                // Add error message next to the input field
                $(this).after("<span class='error-message text-danger'><small>Please enter a valid price. Format: 0.00<small/></span>");
            }
        });

        $("#email").on("input", function() {
            // Regular expression to allow only numbers, optional decimal point, and up to 2 decimal places
            const regex = /^[\w\-\.]+@([\w-]+\.)+[\w-]{2,}$/;

            // Check if the entered value matches the regular expression
            const isValid = regex.test($(this).val());

            // Set error message and style based on validity
            if (isValid) {
                $(this).removeClass("error");
                $(this).siblings(".error-message").remove(); // Remove existing error message if present
            } else {
                $(this).addClass("error");
                $(this).siblings(".error-message").remove();
                // Add error message next to the input field
                $(this).after("<span class='error-message text-danger'><small>Please enter a valid email address.<small/></span>");
            }
        });

        $("#admin_email").on("input", function() {
            // Regular expression to allow only numbers, optional decimal point, and up to 2 decimal places
            const regex = /^[\w\-\.]+@([\w-]+\.)+[\w-]{2,}$/;

            // Check if the entered value matches the regular expression
            const isValid = regex.test($(this).val());

            // Set error message and style based on validity
            if (isValid) {
                $(this).removeClass("error");
                $(this).siblings(".error-message").remove(); // Remove existing error message if present
            } else {
                $(this).addClass("error");
                $(this).siblings(".error-message").remove();
                // Add error message next to the input field
                $(this).after("<span class='error-message text-danger'><small>Please enter a valid email address.<small/></span>");
            }
        });

        $("#phone").on("input", function() {
            // Regular expression for phone number validation (adjust for your country's format if needed)
            const regex = /^\d{10}$/;

            // Check if the entered value matches the regular expression
            const isValid = regex.test($(this).val());

            if (isValid) {
                $(this).removeClass("error");
                $(this).siblings(".error-message").remove(); // Remove existing error message if present
            } else {
                $(this).addClass("error");
                $(this).siblings(".error-message").remove();
                // Add error message next to the input field
                $(this).after("<span class='error-message text-danger'><small>Please enter a valid phone number.<small/></span>");
            }
        });
        $("#admin_phone").on("input", function() {
            // Regular expression for phone number validation (adjust for your country's format if needed)
            const regex = /^\d{10}$/;

            // Check if the entered value matches the regular expression
            const isValid = regex.test($(this).val());

            if (isValid) {
                $(this).removeClass("error");
                $(this).siblings(".error-message").remove(); // Remove existing error message if present
            } else {
                $(this).addClass("error");
                $(this).siblings(".error-message").remove();
                // Add error message next to the input field
                $(this).after("<span class='error-message text-danger'><small>Please enter a valid phone number.<small/></span>");
            }
        });
    });
</script>

</body>
</html>    
