<?php include "config.php"; 
$page = "chat"; 
?>
<?php
  //  if(isset($_POST['edittmsg'])){
  //   $msgid = $_POST['msgid'];
  //   $editmsgtext = $_POST['editmsgtext'];
  //   $update  = mysqli_query($connection,"UPDATE messages SET message_send = '$editmsgtext' WHERE id='$msgid' ") ;

  //  }
   ?>
   <?php
  if(isset($_POST['delete'])){
    $delid = $_POST['delid'];
    $delmsg = mysqli_query($connection,"DELETE FROM messages WHERE id ='$delid'");

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="shortcut icon" href="image/tb_logo.webp" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="dashboard.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
       .message{
        margin-left: 15rem; 
   margin-top: 6rem;
       }

       .formedit{
        width:40%;
        justify-content:center;
        align-items:center;
        background:white;
        z-index:99;
        position:fixed;
        left:50%; 
         top:15%;
         display:none;
       transform: translate(-50%,-50%);
       animation:SlideInDown ;
       }
       .formedit.edit_show{
        display:flex;
       }
       @keyframes SlideInDown {
        0%{
         
          transform:translateY(-60%);
        }
        100%{
          transform:translateY(0);
        }
        
       }
       .message_edit_delete{
        display:none;
       }
       .message_edit_delete.show{
        display:block;
       }
       .form-to-edit{
        border-radius:10px;
        display:flex;
        width:100%;
        flex-direction:column;
        gap:20px;
        box-shadow:2px 2px 2px 2px rgb(220, 216, 216);
        padding:20px;
       z-index:99;
       } 
       .edit-text{
        width:90%;
        padding:10px;
        outline:0;
        border-radius:10px;
        border:1px solid black;
             }
       .submit{
        width:30%;
        color:white;
        background:#8B5E3C;
        padding:10px;
        border:0;
        border-radius:7px;
        display:flex;
        gap:10px;
        justify-content:center;
       }
       @media screen and (max-width:768px) {
  .message{
        margin-left: 1rem;
  margin-top: 1rem;
       } 
       .images{
  width:10%;
  border-radius:50%;
}
}
    </style>
</head>
<body>
<?php
  include "header.php";
?>
    <div class="user_dashboard">
      <div class="menu">
    <?php 
   include "dashboard.php";
    ?>
    </div>
    </div>
<div class="message">

    <div class="user_id">
  <?php
  //  delete message

// get user id
if(isset($_GET["friend_id"])){
   $friend_id = $_GET['friend_id'];
}
   $user_id = $_SESSION['userid'];
    $query = mysqli_query($connection,"SELECT * FROM user WHERE id = '$friend_id'");
    while($row = mysqli_fetch_array($query)){
  ?>
  <div class="user_profile" style="display:flex; gap:20px; border-bottom:2px solid whitesmoke; padding:10px 0;  align-items:center;">
    <?php 
   if(!empty($row['profile_image'])){
    ?>
     <img style="width:3%; border-radius:50%;" src="image/<?php echo $row['profile_image'];  ?>" alt="" srcset="">
    <?php
   }else{
    ?>
    
 <h1 style="color: white;
    font-size: 20px;
    display: flex;
    border-radius: 50%;
    align-items: center;
    justify-content: center;
    background-color: brown;
    height: 50px;
    width: 50px;">
 <?php
     echo strtoupper(substr($row['email'], 0, 2)); 
      ?> 
  </h1>   
 <?php  }
 ?>  
   <p><?php echo $row['username'];  ?></p>
 
  <?php
    }
  ?>
    </div>
  </div>
  <div class="show_message">
 <?php
   $msg = mysqli_query($connection, "SELECT * FROM messages WHERE (sender_id ='$user_id' AND receiver_id='$friend_id') || (receiver_id ='$user_id' AND sender_id='$friend_id') order by id asc");
   while($reply = mysqli_fetch_array($msg)){
   
    if($reply['sender_id']===$friend_id){
      
 ?>
   <div class="sent-message" style="display:flex; ">  
 <p  style="text-align:left; float:left; padding:7px;  margin-top:20px; margin-right:10px; 
 width:20%; border-radius:15px; border-bottom-right-radius:0;
 color:white; background-color: #777;"><?php
  echo $reply['message_send'];
  ?></p><br>
   </div>
 <?php
   }else{
    $_SESSION['reply_id'] = $reply['id'];

 ?>

 <?php


 ?>
<div class="formedit" id='formedit'>

    <form action="" id="editmsgtext" method="POST" class="form-to-edit">
      <input type="hidden" name="msgid" value="<?php  echo $reply['id']; ?>"> 
      <input type="hidden" name="friendid" value="<?php  echo $_GET['friend_id']; ?>"> 
      <input type="text" class="edit-text" value="<?php  echo $reply['message_send']; ?>" name="editmsgtext" id="">
    <center><button type="submit" class="submit" name="edittmsg"><span>Edit</span> <i class="fa fa-pen"></i></button>
    </center>  
    </form>
      </div>
 <div class="msg_row" style="display:flex; flex-direction:column; right:0; justify-content:flex-end; align-items:end;">
 <p id="edit_delete-<?php echo $reply['id'];  ?>" class="edit_delete"  style="text-align:left; cursor:pointer;  margin-top:20px; padding:7px; width:20%; border-radius:15px;  border-bottom-left-radius:0;
 color:white; background-color:#8B5E3C;"><?php echo $reply['message_send']  ?>
 </p>
 <span  class="message_edit_delete">
<p class="edit" style="cursor:pointer;"  id="edit-<?php echo $reply['id']; ?>">edit <i class="fa fa-pen"></i></p>
  <p>
    <?php

?>
    <form action="" id="delemsg" method="POST">
   <input type="hidden" value="<?php  echo $reply['id']; ?>" name="delid">
   <button type="submit" name="delete" style="background:none; border:0; font-size:15px;
   font-weight:600; cursor:pointer; padding:10px;">delete</button>
    </form>
  </p>
 </span>
</div>
 <?php
  }

  }
 ?>
  </div>
  <div class="user_message" style="width:83%; right:0; position:fixed; bottom:0;">
  <form id="contact-form" action="" method="POST" style="display:flex; gap:10px; align-items:center;">
    <input type="hidden" name="sender_id" value="<?php echo $_SESSION['userid']; ?>">
    <input type="hidden" value="<?php  echo  $friend_id;  ?>"  name="receiver_id">

    <textarea required placeholder="send a message..."  name="message_send" id="text-msg"  style="width:90%; outline:0; resize:none; padding:5px 2px;" cols="2"  rows="1"></textarea>
<button type="submit" name="sendsms" style="padding:10px 20px; border:0; border-radius:10px; color:white; background-color:#8B5E3C;"><i class="fa-solid fa-paper-plane"></i></button>
  </form>
  <!-- <div id="response"></div> -->
</div>
</div>
</body>
<script src="msg.js"></script>

</html>