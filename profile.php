<?php 
 include ('config.php');
$page = "profile";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="profile.css">
    <link rel="shortcut icon" href="image/tb_logo.webp" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="dashboard.css"> 
    <style>
        .header{
            z-index: 99;
            background:white;
        }
    </style>
</head>

<body>
<?php
  include "header.php";
?>
<div class="user_all">
 <div class="user_dashboard">
    <div class="menu">
    <?php include "dashboard.php"; ?> 
</div>
</div>
    <div class="profile">
      
        <!-- User Profile Section (aligned to the left as requested) -->
        <div class="user_profile">
            <?php    
       $query = "SELECT * FROM user WHERE id ='".$_SESSION['userid']."' ";
                $result = mysqli_query($connection, $query);
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)) {                       
            ?>
            <?php
 if(!empty($row['profile_image'])){
?>
  <img style="width:10%; border-radius:50%;" src="image/<?php echo $row['profile_image'];  ?>" alt="">
<?php
 }else{
?>
            <h1><?php echo strtoupper(substr($row['email'], 0, 2));
         }?></h1>
            <div class="like_name">      
                <h2><?php echo $row['username']; ?></h2>
                <a href="edit.php" style="background-color:#8B5E3C;
                padding:0 10px;
                text-decoration:none; border-radius:5px;
                 color:white;">edit profile</a>
            </div>
            
        </div>

        <?php
            }
        }                 

        $poster_id = $_SESSION['userid'];
        $select_query = "SELECT * FROM media WHERE poster_id = $poster_id";
        $select = mysqli_query($connection, $select_query);
        if ($select && mysqli_num_rows($select) > 0) {
            while ($video_row = mysqli_fetch_array($select)) {
                $queryy = "SELECT * FROM user WHERE id = '".$_SESSION['userid']."' ";
                $resultt = mysqli_query($connection, $queryy);
                if ($resultt && mysqli_num_rows($resultt) > 0) {
                    while ($roww = mysqli_fetch_array($resultt)) {
        ?>
        
        <div class="video_uploaded">
            <div class="date_posted">
            <?php
 if(!empty($roww['profile_image'])){
?>
  <img style="width:10%; border-radius:50%;" src="image/<?php echo $roww['profile_image'];  ?>" alt="">
<?php
 }else{
?>
                <h1><?php echo strtoupper(substr($roww['email'], 0, 2)); } ?></h1>
                <p>You posted a video on <?php echo $video_row['post_date']; ?></p> 
            </div>

            <p><?php echo $video_row['comment']; ?></p>
            <div class="each_video">
                <video class="video_play" src="video/<?php echo $video_row['file_upload']; ?>" controls></video> 
            </div>
        </div>

        <?php  
            }
        }
    }
}
?>
    </div>
    </div>
    <script src="dashboard.js"></script>
</body>
</html>
