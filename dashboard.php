
<div class="preloader" id="preloader">
        <div class="loader" id="loader">
            <img style="width: 7%;
    border-radius: 50%;" src="image/tb_logo.webp" alt="">
            <h1 style="
                color:#8B5E3Cem;">TickleByte</h1>
        </div>
</div> 

    <!-- <div id="container" class="container"> -->

 


            <div class="sidebar">  
                <p><a href="index.php" class="sidebar-link <?php echo ($page==='trends')?'active':'';?>">
                    <i class="fa fa-home"></i>
                    <span>Trends</span></a>
                </p>
                <?php 
            if(!isset($_SESSION['userid'])){
            ?>
                <p><a href="login.php" class="sidebar-link <?php echo ($page==='post')?'active':'';?>">
                    <i class="fa fa-plus"></i>
                    <span>Create post</span></a>
                </p>
                <?php
            }else{
                ?>
                <p><a href="post.php" class="sidebar-link <?php echo ($page==='post')?'active':'';?>">
                    <i class="fa fa-plus"></i>
                    <span>Create post</span></a>
                </p>
            <?php 

            }
            if(!isset($_SESSION['userid'])){
            ?>
            <p><a href="login.php" class="sidebar-link <?php echo ($page==='profile')?'active':'';?>">
                    <i class="fa fa-user"></i>
                    <span>Profile</span></a>
                </p>
              
                <?php
            }else{?>
                    <p><a href="profile.php" class="sidebar-link <?php echo ($page==='profile')?'active':'';?>">
                    <i class="fa fa-user"></i>
                    <span>Profile</span></a>
                </p>
           <?php }
                ?>
               <?php 
if(!isset($_SESSION['userid'])){
?>
<p><a href="login.php" class="sidebar-link <?php echo ($page==='chat')?'active':'';?>">
        <i class="fa fa-message"></i>
        <span>chat</span></a>
    </p>
  
    <?php
}else{?>
        <p><a href="chat.php" class="sidebar-link <?php echo ($page==='chat')?'active':'';?>">
        <i class="fa fa-message"></i>
        <span>chat</span></a>
    </p>
<?php }
    ?>
                   <?php 
if(!isset($_SESSION['userid'])){
?>
<p><a href="login.php" class="sidebar-link <?php echo ($page==='bookmark')?'active':'';?>">
        <i class="fa fa-bookmark"></i>
        <span>Bookmarks</span></a>
    </p>
  
    <?php
}else{?>
        <p><a href="bookmark.php" class="sidebar-link <?php echo ($page==='bookmark')?'active':'';?>">
        <i class="fa fa-bookmark"></i>
        <span>Bookmarks</span></a>
    </p>
<?php }
    ?>
    
                </div>
                <div class="log_out">
                    <?php  
                    if(isset($_SESSION['userid'])){
                    ?>
                <p><a href="login.php" class="sidebar-link">
                    <i class="fa fa-right-from-bracket"></i>
                    <span>Log out</span></a>
                </p>
                <?php
                    }
                ?>
               </div> 
     
          
       
        <script>
            document.addEventListener('DOMContentLoaded', function(){
    const preloader = document.getElementById('preloader');
    const container = document.getElementById('container');
    setTimeout(function() {
        preloader.style.display='none';
        container.style.display=' block';
    }, 1000); 
});
        </script>
    <script src="dashboard.js"></script>