<?php include "config.php";
 ?>

<?php
  if(!empty($_POST)){

  $sender_id = $_POST['sender_id'];
  $receiver_id = $_POST['receiver_id'];
  $message_send = $_POST['message_send'];
  $insert = "INSERT INTO messages(sender_id,receiver_id,message_send) VALUES ('$sender_id','$receiver_id','$message_send')";
  $insert_message  = mysqli_query($connection,$insert);
  if($insert_message){
    $msg='<div class="msg_row" style="display:flex; justify-content:flex-end;">
    <p  style="text-align:left;  margin-top:20px; padding:7px; width:20%; border-radius:15px;  border-bottom-left-radius:0;
    color:white; background-color:#8B5E3C;">'.$message_send.'</p><br>
   </div>';
    echo $msg;
  }else{
    echo 'error';
  }
}
  
?>
