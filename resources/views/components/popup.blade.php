<div class="modal fade" id="popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 900px !important">
        <div class="modal-content">
            {{-- <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Popup Title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> --}}
            <div class="modal-body" id="popup-content">
                <!-- Content loaded via AJAX will be placed here --> 
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="close-model" data-dismiss="modal">Close</button>
            </div> --}}
        </div>
    </div>
</div>

{{-- <style>
    .model-dialog {
        max-width: 1200px !important;
    }
</style> --}}

<script>
$(document).ready(function(){
    $('.open-popup').off('click').on('click', function(){   //.off('click') removes the previous click events
        var url = $(this).data('href');
        $.ajax({
            url: url,
            method: "GET",
            success: function(response){
                $('#popup-content').html(response);
                $('#popup').modal('show');
            }
        });
        return false; // Prevent default anchor tag behavior
    });

    // $('.close-model').click(function() {
    //     $('#popup').hide();
    // });
});
</script>


