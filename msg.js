const edit = document.querySelectorAll('.edit');
        const formedit = document.querySelectorAll('.formedit');
        edit.forEach((butto, index) => {
            butto.addEventListener('click', function() {
              formedit[index].classList.toggle('edit_show');
            });
          });
            const edit_delete = document.querySelectorAll('.edit_delete');
        const message_edit_delete = document.querySelectorAll('.message_edit_delete');
        edit_delete.forEach((butt, inde) => {
            butt.addEventListener('click', function() {
              message_edit_delete[inde].classList.toggle('show');
            });
        });
    //   send message
  jQuery(document).ready(function(){
    jQuery('#contact-form').on('submit', function(event){
        event.preventDefault();
        var formData = jQuery(this).serialize();
        jQuery.ajax({
            url: 'msg-ajax.php', 
            type: 'POST',
            data: formData,
            success: function(response){
                jQuery('.show_message').append(response);
                jQuery('#text-msg').val('');
            },
            error: function(){
                jQuery('.show_message').html('Error submitting the form.');
            }
        });
    });
});
  

//         // update ajax
jQuery(document).ready(function(){
  jQuery('#editmsgtext').on('submit', function(e){
      e.preventDefault(); 

      var formData = $(this).serialize(); 
      var msgid = $(this).find()

      jQuery.ajax({
          url: 'editajax.php',  
          type: 'POST', 
          data: formData,  
          success: function(rep){
            jQuery('#formedit').css('display','none');
            jQuery('#edit-delete').css('display','none');
          },
          error: function(){
            jQuery('#response').html('Error submitting the form.');
          }
      });
  });
});
// // delete ajax

// $(document).ready(function(){
//     // Handle form submission
//     $('#delemsg').on('submit', function(e){
//         e.preventDefault();  // Prevent form from reloading the page
  
//         var formData = $(this).serialize(); // Serialize form data
//         $.ajax({
//             url: 'deleteajax.php',  // PHP file that will process the form
//             type: 'POST',  // HTTP method
//             data: formData,  // Data sent to PHP file
//             success: function(res){
//   console.log(formData);
//   $('.show_message').remove(res);
//             },
//             error: function(){
//                 // Handle any errors
//                 $('.show_message').html('Error submitting the form.');
//             }
//         });
//     });
//   });

