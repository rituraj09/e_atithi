// $(document).ready(function() {
//     $("#open-popup").click(function() {
//       var url = $(this).data('url');
  
//       $.ajax({
//         url: url,
//         success: function(data) {
//           $("#popup-content").html(data);
//           $("#popup-container").removeClass("popup-hidden").addClass("popup-visible");
//         },
//         error: function(jqXHR, textStatus, errorThrown) {
//           console.error("Error loading content:", textStatus, errorThrown);
//         }
//       });
//     });
  
//     $("#close-popup").click(function() {
//       $("#popup-container").removeClass("popup-visible").addClass("popup-hidden");
//     });
// });
  

// $(document).ready(function () {
//     /* When click show user */
//     $('body').on('click', '#show-user', function () {
//         var userURL = $(this).data('url');
//         $.get(userURL, function (data) {
//             $('#userShowModal').modal('show');
//             $('#user-id').text(data.id);
//             $('#user-name').text(data.name);
//             $('#user-email').text(data.email);
//         })
//     });

// });

// <div class="modal fade" id="popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
//     <div class="modal-dialog" role="document">
//         <div class="modal-content">
//             <div class="modal-header">
//                 <h5 class="modal-title" id="exampleModalLabel">Popup Title</h5>
//                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
//                     <span aria-hidden="true">&times;</span>
//                 </button>
//             </div>
//             <div class="modal-body" id="popup-content">
//                 {/* <!-- Content loaded via AJAX will be placed here -->  */}
//             </div>
//             <div class="modal-footer">
//                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
//             </div>
//         </div>
//     </div>
// </div>



// $(document).ready(function(){
//     $('.open-popup').click(function(){
//         var url = $(this).attr('href');
//         $.ajax({
//             url: url,
//             method: "GET",
//             success: function(response){
//                 $('#popup-content').html(response);
//                 $('#popup').modal('show');
//             }
//         });
//         return false; // Prevent default anchor tag behavior
//     });
// });
