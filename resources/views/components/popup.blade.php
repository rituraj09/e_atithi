{{-- <div id="popup-container" class="popup-hidden">
    <div class="card shadow">
        <div class="d-flex align-items-center mb-2 p-2 border-bottom">
            <h5 class="card-title col m-0">Card title</h5>
            <button class="btn" id="close-popup">x</button>
        </div>
        <div class="card-body">
            
        </div>
    </div>
</div>

<style>
    .popup-hidden {
      display: none;
    }
  
    .popup-visible {
      /* Define styles for the visible popup */
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 400px;
      background-color: white;
      padding: 20px;
      border: 1px solid #ccc;
      z-index: 10; /* Ensure popup is above other elements */
    }
</style> --}}


    {{-- <div id="popup-content"></div> --}}



<!-- Modal -->
{{-- <div class="modal fade" id="userShowModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Show User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>ID:</strong> <span id="user-id"></span></p>
                <p><strong>Name:</strong> <span id="user-name"></span></p>
                <p><strong>Email:</strong> <span id="user-email"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div> --}}

{{-- <div class="model">

</div> --}}






<div class="modal fade" id="popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 900px !important">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Popup Title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="popup-content">
                <!-- Content loaded via AJAX will be placed here --> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="close-model" data-dismiss="modal">Close</button>
            </div>
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
    $('.open-popup').click(function(){
        // var url = $(this).attr('href');
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


