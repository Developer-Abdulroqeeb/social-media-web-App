<?php
include "config.php";
// Define the page name
$page = "trends";

// Handle comment submission
if (isset($_POST['submit_2'])) {
    $individual_comment = $_POST['individual_comment'];
    $commenter_id = $_SESSION['userid'];
    $video_posted_id = $_POST['video_posted_id'];

    // Insert comment into the database
    $insert_comment = "INSERT INTO video_comment(individual_comment, commenter_id, video_posted_id) 
    VALUES('$individual_comment', '$commenter_id', '$video_posted_id')";
    $insert_query = mysqli_query($connection, $insert_comment);
}


// handle reply submission
  if(isset($_POST['replycom'])){
    $video_replyto = $_POST['video_replyto'];
    $co_id = $_POST['co_id'];
  $replier_id = $_POST['replier_id'];
  $replies = $_POST['replies'];
  $commentids = $_POST['commentids'];
  $insert_reply = "INSERT INTO reply(video_replyto,co_id,replier_id,replies,commentids) 
  VALUES('$video_replyto', '$co_id', '$replier_id','$replies','$commentids')";
  $reply_query = mysqli_query($connection, $insert_reply);
  }
    // handle bookmarkingm
    if(isset($_POST['bookmark'])){
      $video_bookmark = $_POST['video_bookmark'];
      $bookmarker_id = $_POST['bookmarker_id'];
       $selct_book = mysqli_query($connection, "SELECT * FROM bookmarks WHERE video_bookmark='$video_bookmark' AND bookmarker_id = '$bookmarker_id'");
       if(mysqli_num_rows($selct_book)>0){
        $del_book = mysqli_query($connection,"DELETE FROM bookmarks WHERE video_bookmark='$video_bookmark' AND bookmarker_id='$bookmarker_id'");
       }else{
      $bookmarking = mysqli_query($connection,"INSERT INTO bookmarks(video_bookmark,bookmarker_id) VALUES('$video_bookmark','$bookmarker_id')");
    }    
  }
// reposting video
if(isset($_POST['repost'])){
  $date_reposted = date('Y-m-d H:i:s');
 $reposter_id = $_SESSION['userid'];
 $reposter_comment = $_POST['reposter_comment'];
//  $tar_file = "video/".basename($_FILES['video_reposted ']['name']);
 $video_reposted = $_POST['video_reposted'];
//  if(move_uploaded_file($_FILES['video_reposted ']['name'],$tar_file)){

//  }
 $insert_repost = mysqli_query($connection,"INSERT media(file_upload,comment,post_date,poster_id)  VALUES ('$video_reposted','$reposter_comment','$date_reposted','$reposter_id')");
 if($insert_repost){
  echo "<script>alert('reposted successfully')</script>";

 }
}
// delete comment
if(isset($_POST["delete_comment"])){
  $comm_del_id = $_POST['comm_del_id'];

  $del_comment = mysqli_query($connection,"DELETE FROM video_comment WHERE id ='$comm_del_id'");
}
// edit comment

if(isset($_POST['editcomment'])){
  $editcommid = $_POST['editcommid'];
  $comm_edit = $_POST['comm_edit'];
  $update_comm = mysqli_query($connection, "UPDATE video_comment SET individual_comment = '$comm_edit' WHERE id='$editcommid'");
}
// Handle like/unlike functionality
if (isset($_POST['submit_3'])) {
    $videoidd = $_POST['videoidd'];
    $likerid = $_POST['likerid'];
    $_SESSION['likerid'] = $likerid;

    // Check if the user already liked the video
    $del_like = mysqli_query($connection, "SELECT * FROM like_post WHERE likerid='$likerid' AND videoidd = '$videoidd'");
    if (mysqli_num_rows($del_like) > 0) {
        // If liked, remove the like
        $del = mysqli_query($connection, "DELETE FROM like_post WHERE likerid='$likerid' AND videoidd = '$videoidd'");
    } else {
        // If not liked, add the like
        $insert_like = "INSERT INTO like_post(videoidd, likerid) VALUES('$videoidd', '$likerid')";
        $like_query = mysqli_query($connection, $insert_like);
    }
}
// delte post

if (isset($_POST['deletepost'])) {
    $vid_del = $_POST['vid_del'];

    $get_vid = mysqli_query($connection, "SELECT * FROM media WHERE id = '" . mysqli_real_escape_string($connection, $vid_del) . "'");

    if (mysqli_num_rows($get_vid) > 0) {
        // Fetch the video record
        $vid_row = mysqli_fetch_array($get_vid);
        $vid_path = "video/" . $vid_row['file_upload'];  

        if (file_exists($vid_path)) {
            if (unlink($vid_path)) {
                echo "posti file deleted successfully.";
            } 
        }
        // Delete the video record from the database
        $del_vid = mysqli_query($connection, "DELETE FROM media WHERE id = '" . $vid_del. "'");
       
    } 
}


// Search functionality
$search_post = '';
if (isset($_POST['submit_1'])) {
    $search_post = mysqli_real_escape_string($connection, $_POST['search_post']);
    
    $query = "SELECT media.id AS mediaId, user.id AS user_id, media.*, user.* FROM media 
              LEFT JOIN user ON user.id = media.poster_id 
              WHERE comment LIKE '%$search_post%' OR username LIKE '%$search_post%'";
} else {
    // Default query to fetch all media posts
    $query = "SELECT media.id AS mediaId, user.id AS user_id, media.*, user.* 
              FROM media LEFT JOIN user ON user.id = media.poster_id 
              ORDER BY media.id DESC";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TickleByte Landing page</title>
  <link rel="stylesheet" href="indexs.css">
  <link rel="shortcut icon" href="image/tb_logo.webp" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="dashboard.css">
<style>
  .header{
    z-index:99;
  }
  .delete{
    display:none;
    
  }
</style>
<script>

</script>
  </head>
<body>
  <div class=""></div>
<?php
  include "header.php"
?>
    <div class="user_dashboard">
    <div class="menu">
        <?php include "dashboard.php"; ?>
        </div> 
</div>
    <div class="trends">
        <div class="serach_reels">
            <form action="" id="myForm" method="POST">
                <input type="text" value="<?php echo $search_post; ?>" placeholder="Search Post" name="search_post" id="">
                <button type="submit" name="submit_1">Search</button>
            </form>
        </div>
        <!-- Content Section -->
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
        <span><i class="fa fa-thumbs-up"></i></span>
            </p>
           </button>
           <?php
          }else{

           ?>
         <p>
          <a style="color:black; text-decoration:none;" href="login.php">
        <span><i class="fa fa-thumbs-up"></i></span>
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
        <span><i class="fa fa-comment"></i> <?php
              $vid_id = $row['mediaId'];
             $comm_query = mysqli_query($connection, "SELECT * FROM video_comment WHERE video_posted_id='$vid_id'");
                echo mysqli_num_rows($comm_query); ?>
              </span>
              </p>
 <?php
}else{
 ?>
 <p>
   <a style="color:black; text-decoration:none;"  href="login.php"><span><i class="fa fa-comment"></i>
    <?php
        $vid_id = $row['mediaId'];
             $comm_query = mysqli_query($connection, "SELECT * FROM video_comment WHERE video_posted_id='$vid_id'");
                echo mysqli_num_rows($comm_query); ?>
              </span>
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
              <p><span>
              <i class="fa-solid fa-share"></i></p>
              </span>
             
              </button>
<?php
            }else{
?>
 <p>
      <a  style="color:black; text-decoration:none;" href="login.php">
             <span> <i class="fa-solid fa-share"></i>
              </span>
             
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
        } ?>
     </div>
     <div class="buttons">
       <button class="btn" id="prevButton"><i class="fa fa-chevron-up"></i></button>
      <button class="btn" id="nextButton"><i class="fa fa-chevron-down"></i></button>
            </div>
        </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>        
<script src="index.js"></script>
    <script>
const play = document.querySelectorAll('.play-icon');
const pause = document.querySelectorAll('.pause-icon');
const video = document.querySelectorAll('.video_play');
const videowatch = document.querySelectorAll('.video_play');
const userid = <?php echo $_SESSION["userid"];    ?>;
video.forEach((vid, index) => {
    vid.addEventListener('play',function () {
        play[index].style.display = "none";
        pause[index].style.display = "block";
    });

    vid.addEventListener('pause', function () {
        play[index].style.display = "block";
        pause[index].style.display = "none";
    });
});

</script>
<?php
//  $view_result = mysqli_query($connection, $query);
//  while($row_res=mysqli_fetch_array( $view_result)){
//    echo $row_res['mediaId'];  
// }
?>
<script>
  // function onVideoEnd() {
  //   }

  function sendVideoEndData(videoId, userid) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "view.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.send(`videoId=${videoId}&userid=${userid}`);

    xhr.onload = function() {
        if (xhr.status === 200) {
            console.log("Data saved successfully!");
        } else {
            console.log("Error saving data.");
        }
    };
}

videowatch.forEach(video => {
    video.addEventListener('ended', function() {
        // Get the video id from the data attribute
        var videoId = video.getAttribute('data-video-id');
        console.log(videoId);

   
        
        // Call the function with the video ID and user ID
        sendVideoEndData(videoId, userid);
    });
});



    </script>
</body>
</html>