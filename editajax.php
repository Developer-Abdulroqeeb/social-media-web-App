<?php
  include "config.php";
?>
<?php
   if(!empty($_POST)){
    $msgid = $_POST['msgid'];
    $editmsgtext = $_POST['editmsgtext'];
    $update  = mysqli_query($connection,"UPDATE messages SET message_send = '$editmsgtext' WHERE id='$msgid' ") ;

   }
?>