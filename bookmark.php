<?php 
 include ('config.php');
$page = "bookmark";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bookmark</title>
    <link rel="shortcut icon" href="image/tb_logo.webp" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="dashboard.css"> 
    <link rel="stylesheet" href="bookmarks.css"> 
    <style>
        .user_profile{
            display:flex;
             align-items:center;
              gap:20px;
              border-bottom:2px solid whitesmoke;
              padding:10px 0;
        }
        .header{
          z-index: 99;
          
        }
    </style>
</head>

<body>
<?php
  include "header.php";
?>
 <div class="user_dashboard">
  <div class="menu">
    <?php include "dashboard.php"; ?> 
      </div>
      </div>
    <div class="trends">
      <!-- User Profile Section (aligned to the left as requested) -->
      <div class="user_profile" >
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
          </div>
          
      </div>
      <?php
            }
        }  
        ?>
        <?php
        $user_book = $_SESSION['userid'];
        // echo $_SESSION['userid'];
        // echo $_SESSION['med'];
    $book_selct = mysqli_query($connection, "SELECT * FROM bookmarks WHERE bookmarker_id = '$user_book'");
   while($row = mysqli_fetch_assoc($book_selct)){
   if(isset($row['video_bookmark'])){
    $_SESSION['book'] = $row['video_bookmark'];
   }
   
  if($_SESSION['med'] = $_SESSION['book']){
    $query = "SELECT media.id AS mediaId, user.id AS user_id, media.*, user.* 
              FROM media LEFT JOIN user ON user.id = media.poster_id WHERE media.id = '".$_SESSION['book']."'
              ORDER BY media.id DESC";
?>
 <div class="content-div" style="display:flex; justify-content:center;">
            <div class="video_uploaded">
                <?php
                $result = mysqli_query($connection, $query);
                if ($result && mysqli_num_rows($result)){
                    while ($row = mysqli_fetch_array($result)) {
                      $_SESSION['med'] = $row['mediaId'];
                ?>
         <div class="each_video">      
         <div class="" >
     <div  class="poster_profile">    
     <?php
 if(!empty($row['profile_image'])){
?>
  <img style="width:10%; border-radius:50%;" src="image/<?php echo $row['profile_image'];  ?>" alt="">
<?php
 }
 else {
?>
     <h1 style=" color: white;
    font-size: 20px;
    display: flex;
    border-radius: 50%;
    align-items: center;
    justify-content: center;
    background-color: brown;
    height: 50px;
    width: 50px;"><?php
     
        echo strtoupper(substr($row['email'], 0, 2)); 
        }
       ?></h1>
           </div>     
     <p><?php echo $row['username']; ?> posted this on <?php echo $row['post_date']; ?></p>
     <?php  
     if(isset($_SESSION['userid']) && $_SESSION['userid'] === $row['poster_id']){
     ?>
     <form action="" method="post" style="display:flex; justify-content:flex-end;">
      <input type="hidden" value="<?php echo $row['mediaId'];  ?>" name="vid_del">
      <button type="submit" name="deletepost" style="background:none; cursor:pointer; border:0;"><span class="delete">delete</span> <i  style="font-size:20px; color:#8B5E3C;" class="fa fa-trash"></i> </button>
     </form>
     <?php 
     }
     ?>
     </div>
         <div class="video_flex">
  <p><?php echo $row['comment']; ?></p>
  <div class="video-container">

   <video controls class="video_play" data-video-id="<?php echo $row['mediaId']; ?>" src="video/<?php echo $row['file_upload']; ?>">
 </video>
   <div class="pause_play">  <!-- Play/Pause Overlay -->
       <p class="overlay-icon play-icon">&#9654;</p>
        <p class="overlay-icon pause-icon">&#10074;&#10074;</p>
        </div>
        </div> 
        <div class="" style="display:flex; align-items:center; justify-content:space-between;">
        <div class="">
              <?php
     $vid_id = $row['mediaId'];

      // $_SESSION['users_idd'] = $_SESSION['userid'];
   
   // Check if the user has liked the video
   if(isset($_SESSION['userid'])){
     $select_like = mysqli_query($connection, "SELECT * FROM like_post WHERE videoidd = '$vid_id' AND likerid ='".$_SESSION['userid']."' ");
      $user_liked = mysqli_num_rows($select_like) > 0;
   $query_total_likes = mysqli_query($connection, "SELECT * FROM like_post WHERE videoidd = '$vid_id'");
   $total_like = mysqli_num_rows($query_total_likes);
  }else{
   $select_like = mysqli_query($connection, "SELECT * FROM like_post WHERE videoidd = '$vid_id' ");
    $user_liked = mysqli_num_rows($select_like) > 0;
     $query_total_likes = mysqli_query($connection, "SELECT * FROM like_post WHERE videoidd = '$vid_id'");
   $total_like = mysqli_num_rows($query_total_likes);
  }
  // Display like information
             if (isset($_SESSION['userid']) && $user_liked) {
              if(($total_like - $user_liked) == 0){
                echo "<p> you like this post</p>";
              }else if($total_like > 0){
                echo"<p>you and"."  ".$total_like-1 ."  " ."other like this post</p>";
              }else{
              echo"<p>you and"."  ".$total_like."  " ."other like this post</p>";
              }
             } else {
              if($total_like==1){
           echo "<p>" . $total_like . " like</p>";
              }else{
                echo "<p>" . $total_like . " likes</p>";
              }
              
            }
            ?>
            </div>
             <div class="select_view">
             <?php
              $selct_view = mysqli_query($connection,"SELECT  * FROM view WHERE videoId = '$vid_id' && userid != '' ");
              $row_view = mysqli_fetch_array($selct_view);
                if(mysqli_num_rows($selct_view) === 1){
                echo mysqli_num_rows($selct_view)."   "."view";
                }else{
                  echo mysqli_num_rows($selct_view)."   "."views";
                }
                ?>
          </div>
          </div>
      <div class="like_comment" >
      <form action="" id="commentForm" method="POST">
      <input type="hidden" value="<?php echo $row['mediaId']; ?>" name="videoidd">
   <input type="hidden" value="<?php if (isset($_SESSION['userid'])) {
    echo $_SESSION['userid'];} ?>" name="likerid">
          <?php
          if(isset($_SESSION['userid'])){
          ?>
         <button type="submit" class="like" id="like-<?php echo $row['mediaId']; ?>" name="submit_3">
         <p>
        <span>Like</span><i class="fa fa-thumbs-up"></i>
            </p>
           </button>
           <?php
          }else{

           ?>
         <p>
          <a style="color:black; text-decoration:none;" href="login.php">
        <span> Like</span><i class="fa fa-thumbs-up"></i>
            </p>
          </a>
<?php  
          }
?>
       </form>
       <?php
       if(isset($_SESSION['userid'])){
       ?>
      <p class="comment" id="comment-<?php echo $row['mediaId']; ?>">
        <span>Comment <?php
              $vid_id = $row['mediaId'];
             $comm_query = mysqli_query($connection, "SELECT * FROM video_comment WHERE video_posted_id='$vid_id'");
                echo mysqli_num_rows($comm_query); ?>
              </span><i class="fa fa-comment"></i>
              </p>
 <?php
}else{
 ?>
 <p>
   <a style="color:black; text-decoration:none;"  href="login.php">     <span>Comment
    <?php
        $vid_id = $row['mediaId'];
             $comm_query = mysqli_query($connection, "SELECT * FROM video_comment WHERE video_posted_id='$vid_id'");
                echo mysqli_num_rows($comm_query); ?>
              </span><i class="fa fa-comment"></i>
              </a>
              </p>
      <?php
}
      ?>        
          <form action="" method="post" enctype="multipart/form-data">
          <div class="share">
            <input type="hidden" value="" name="reposter_id">
            <input type="hidden"  name="date_reposted">
            <input type="hidden" value="<?php echo $row['comment']  ?>" name="reposter_comment">
            <input type="hidden" value="<?php echo $row['file_upload'];   ?>"  name="video_reposted" >
           <?php
            if(isset($_SESSION['userid'])){
           ?>
            <button  type="submit" name="repost">
              <p><span>share

              </span>
              <i class="fa-solid fa-share"></i></p>
              </button>
<?php
            }else{
?>
 <p>
      <a  style="color:black; text-decoration:none;" href="login.php">
             <span>share
              </span>
              <i class="fa-solid fa-share"></i>
      </a>
      </p>
<?php
   }
?>
 </div>
 
      </form>
      <?php
   if(isset($_SESSION['userid'])){
     ?>
     <form action="" method="POST">
      <input type="hidden" value="<?php echo $_SESSION['med'];   ?>" name="video_bookmark">
      <input type="hidden" value="<?php echo $_SESSION['userid'];  ?>" name="bookmarker_id">
  <button  type="submit" name="bookmark">
  <p><i class="fa fa-bookmark"></i></p>
  </button>
  </form>
<?php
 }else{
?>
 <p>
 <a style="color:black; text-decoration:none;" href="login.php">
    <i class="fa fa-bookmark"></i>
      </a>
  </p>
<?php
   }
?>
        </div>
          <div class="show_comment" id="show_comment-<?php echo $row['mediaId']; ?>">
          <div class="comment_section">
         <form action="" id="" method="POST">
        <input type="hidden" name="video_posted_id" value="<?php echo $row['mediaId']; ?>">
         <input type="text" class="indi_comm" placeholder="Write a comment" name="individual_comment">
         <button class="comm_butt" type="submit" name="submit_2">Comment</button>
         </form>
        
     <!-- Display Comments -->
        <div>
          <?php
      $vid_id = $row['mediaId'];
      // $_SESSION['med'] = $row['mediaId'];
     $comm = mysqli_query($connection, "SELECT * FROM video_comment WHERE video_posted_id='$vid_id'");
     while ($comment_query = mysqli_fetch_array($comm)) {
      $_SESSION['individual'] = $comment_query['individual_comment'];
     $co = $comment_query['id'];
     $_SESSION['commentid'] = $comment_query['id'];
     $selcting = mysqli_query($connection, "SELECT * FROM video_comment WHERE id='$co'");
     while ($selection = mysqli_fetch_array($selcting)) {
       $commenters_id = $selection['commenter_id'];
         // Get the commenter's name
         $_SESSION['comm_id'] = $commenters_id;
       $names = mysqli_query($connection, "SELECT * FROM user WHERE id='$commenters_id'");
        while ($commenter_name = mysqli_fetch_array($names)) {
         ?>
       <div class="comment_name" style="display:flex; align-items:center; gap:15px;">
       <?php
 if(!empty($commenter_name['profile_image'])){
?>
  <img style="width:5%; border-radius:50%;" src="image/<?php echo $commenter_name['profile_image'];  ?>" alt="">
<?php
 }
 else {
?>
   <h1 style=" color: white;
    font-size: 20px;
    display: flex;
    border-radius: 50%;
    align-items: center;
    justify-content: center;
    background-color: brown;
    height: 50px;
    width: 50px;"><?php echo strtoupper(substr($commenter_name['email'], 0, 2));
    ?></h1>
    <?php } ?>
     <p><?php echo $commenter_name['username']; ?></p>
   </div>
  <?php
           }
          }
           ?>
    
    <p class="individual_comment" style='margin-top:10px;  background-color:#8B5E3C; color:white;  width:40%; padding:5px; border-radius:7px;'><?php echo $comment_query["individual_comment"]; ?></p>
   
    <div class="edit_comment">
    <?php 
   if($_SESSION['userid'] === $_SESSION['comm_id']){
   ?>
<form action="" method="POST">
  <input type="hidden" name="comm_del_id" value="<?php
   echo $_SESSION['commentid']; 
     ?>" >
  <button class="delete_comment" name="delete_comment" type="submit">Delete Comment</button>
</form>
<p class="edit_commentis" style="cursor:pointer;">  Edit comment</p>
<?php }else{
        echo "only the commenter can edit and delete the comment";
      } ?>
      </div>
      
      <div class="formedit">
      <form action="" class="form-to-edit" method="post">
        <input type="hidden" value="<?php  echo $_SESSION['commentid'];?>" name="editcommid">
        <input type="text" class="edit-text" value="<?php  echo $_SESSION['individual'];?>" name="comm_edit" id="">
      <center>  <button class="submit" name="editcomment" type="submit">Save changes</button></center>
      </form>
      </div>
   <p style="text-align:center; display:flex; gap:8px; cursor:pointer; align-items:center; justify-content:center;" class="reply" id="reply"> <i class="fa-solid fa-reply"></i><span>reply
    <?php
     $user_id = $_SESSION['userid'];
     $com = $_SESSION['comm_id'];
  $slect_reply = "SELECT * FROM reply LEFT JOIN user on user.id = reply.replier_id  WHERE video_replyto = '$vid_id' AND co_id ='$com' AND replier_id ='$user_id' AND commentids='".$_SESSION['commentid']."' ";
  $select_rep_query = mysqli_query($connection,$slect_reply);
     if(isset($select_rep_query)){
       echo mysqli_num_rows($select_rep_query);
      }
    ?>
   </span></p>
 

         <form action="" id="" method="POST">
        
         
          <div class="reply_section">
          <?php
         
         $slect_reply = "SELECT * FROM reply LEFT JOIN user on user.id = reply.replier_id  WHERE video_replyto = '$vid_id' AND co_id ='$com' AND replier_id ='$user_id' AND commentids='".$_SESSION['commentid']."' ";
          $select_rep_query = mysqli_query($connection,$slect_reply);
          while($rep_row = mysqli_fetch_array($select_rep_query)){
            ?>
            <div class="" style=" gap:10px;">
            <div style="display:flex; align-items:center; gap:2rem; margin:20px 0;">
          <div style="display:flex;  gap:7px;">
          <?php
if(!empty($rep_row['profile_image'])){
          ?>
     
<img style="width:5%; border-radius:50%;" src="image/<?php echo $rep_row['profile_image'];  ?>"  alt="">
<?php
}else{
?>
   <h1 style=" color: white;
    font-size: 15px;
    display: flex;
    border-radius: 50%;
    align-items: center;
    justify-content: center;
    background-color: brown;
    height: 30px;
    width: 30px;"><?php echo strtoupper(substr($rep_row['email'], 0, 2));
    ?></h1>
<?php
}
?>
 <p ><?php echo $rep_row['username'];  ?></p>
 </div>
 <h4 style="background-color:whitesmoke; color:black;  width:40%; padding:5px; border-radius:10px;'"><?php  echo $rep_row['replies']; ?></h4>
</div>

 </div>
            <?php
          }
          ?>
          <input type="hidden" name="commentids" value="<?php echo $_SESSION['commentid'];   ?>">
        <input type="hidden" name="video_replyto" value="<?php echo $row['mediaId']; ?>">
        <input type="hidden"  value="<?php echo $_SESSION['comm_id'];  ?>" name="co_id">
        <input type="hidden" name="replier_id" value="<?php echo $_SESSION['userid'];  ?>">
         <input type="text" style="width:30%; border-radius:5px; padding:7px;" placeholder="Give a reply" name="replies">
         <button type="submit" style="color:white; padding:7px; border-radius:4px; background:#8B5E3C; border:0;" name="replycom">reply</button>
         </div>
         </form>
        
   <?php
       }
    ?>
    
         </div>
     </div>
   </div>
   </div>
  </div>
  <?php }
        } 
    }
} ?>
     </div>
     <div class="buttons">
       <button class="btn" id="prevButton"><i class="fa fa-chevron-up"></i></button>
      <button class="btn" id="nextButton"><i class="fa fa-chevron-down"></i></button>
            </div>   
</div>
<script src="index.js"></script>
</body>
</html>