<?php
include "config.php";

$users = $_SESSION['userid'];
$vid_id = $_SESSION['med'];
$select = mysqli_query($connection,"SELECT * FROM view WHERE userid='$users' AND videoId = '$vid_id' ");
if(mysqli_num_rows($select)>0){

}else{
    if(!empty($_POST) && isset($_SESSION['userid'])){
        $videoId = htmlspecialchars($_POST['videoId']);
        $userid = htmlspecialchars($_POST['userid']) ;
        $insert = mysqli_query($connection,"INSERT INTO view(videoId,userid) VALUES ('$videoId','$userid')");
        
    }
}


?>