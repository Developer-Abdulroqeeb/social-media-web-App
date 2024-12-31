<?php include "config.php"; 
$page = "chat"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TickleByte Chat</title>
    <link rel="shortcut icon" href="image/tb_logo.webp" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="dashboard.css">
    <style>
       .chat{
        margin-left: 15rem;
  margin-top: 6rem;
       } 
       .user_link{
    color:black;
}
body.dark-mode  .user_link{
    color:white;
}
.images{
  width:3%;
  border-radius:50%;
}
.header{
  z-index:99;
  background:white;
}
@media screen and (max-width:768px) {
  .chat{
        margin-left: 1rem;
  margin-top: 2rem;
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
    <div class="chat" style="display:flex; flex-direction:column; gap:20px;">
    <h1>Messages</h1>
   <?php
  //  $user_id = $_SESSION['id'];
     $query = mysqli_query($connection, "SELECT * FROM user WHERE id !='".$_SESSION['userid']."'");
  while($row = mysqli_fetch_array($query)){
    ?>
    <div class="each_user" style="display:flex; gap:10px; align-items:center;"  >
    <?php 
   if(!empty($row['profile_image'])){
    ?>
     <img style="" class="images" src="image/<?php echo $row['profile_image'];  ?>" alt="" srcset="">
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
    width: 50px;"><?php echo strtoupper(substr($row['email'], 0, 2));  ?></h1>   
 <?php  }
 ?>   
   <p >
  <?php echo "<a class='user_link' style= 'text-decoration:none; ' href='message.php?friend_id=" . $row['id'] . "'>" . $row['username'] . "</a>";?>
</p>
</div>
    <?php
  }
  ?>
    </div>
</body>
</html>