 <?php
include "config.php";
$page = "post";
if(isset($_POST['submit'])){
    $post_date = date('Y-m-d H:i:s');
    $poster_id = $_SESSION['userid'];
    $comment = $_POST['comment'];
    $target_dir = "video/";
    $target_file = $target_dir. basename($_FILES["file_upload"]["name"]);
    if( move_uploaded_file($_FILES["file_upload"]["tmp_name"],$target_file)){
    }
    $file_upload = basename($_FILES["file_upload"]["name"]);
    $query = "INSERT INTO media(comment,file_upload,post_date,poster_id) VALUES ('$comment','$file_upload','$post_date','$poster_id')";
    $result = mysqli_query($connection,$query);
  if($result){
    header('Location: index.php');
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TickleByte creating post</title>
    <link rel="stylesheet" href="post.css">
    <!-- <link rel="stylesheet" href="profile.css"> -->
    <link rel="shortcut icon" href="image/tb_logo.webp" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="dashboard.css">
</head>
<style>

</style>
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
 <div class="create_post">
<div class="user_profile">
    
 <?php 
            if(isset($_SESSION['userid'])){
                $query = "SELECT * FROM user WHERE id ='".$_SESSION['userid']."' ";
                $result = mysqli_query($connection,$query);
                if($result && mysqli_num_rows($result)>0){
                      
                    while($row = mysqli_fetch_array($result)){                       
            ?>
            <?php
 if(!empty($row['profile_image'])){
?>
  <img style="width:10%; height:20%; border-radius:70%;" src="image/<?php echo $row['profile_image'];  ?>" alt="">
<?php
 }else{
?>
            <h1><?php echo strtoupper(substr($row['email'],0,2)); } ?></h1>
            
            <div class="like_name">
                
            <h2><?php echo $row['username']; ?></h2>
           
            <?php
                      
                    }
                   }
               
               }  
  ?>
            </div>
        </div>
        <div class="choose_file">
      <p id="vid_duration"></p>
            <h2 style="text-align:center; color:#8B5E3C; margin-bottom:20px;">Create Post</h2>
       <form action="" id="form" method="post" enctype="multipart/form-data"> 
       <input name="file_upload" type="file" id="videoInput" accept="video/*">
    <video id="videoPreview" controls>
        <source id="videoSource" src="" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <img src="image/file-iR4WXoYDTWvBh6Ffki75xuNO (1).jpg" id="videoThumbnail" alt="Video Thumbnail">
    <p id="meta" style="text-align:center; color:red;"></p>
        <div class="post_comment">
       <input  class="text_comment" type="text" placeholder="say something..." name="comment" id="">
       <button name="submit" id="submitButton" type="submit">POST</button>
       </div>   
        </form>       
        </div>
 </div>
</body>
<script src="posts.js"></script>

</html>