<?php
  if(!empty($_POST)){
    $delid = $_POST['delid'];
    $delmsg = mysqli_query($connection,"DELETE FROM messages WHERE id ='$delid'");

}
?>