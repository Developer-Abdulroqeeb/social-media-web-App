<div class="header" >
            <div class="logo">
                <img src="image/tb_logo.webp" alt="">
                <h1 style="
                color:#8B5E3C;
    font-family: algerian;
    font-size: 1rem;">TickleByte</h1>
            </div>
          
            <div class="form_cont">
           
            <div class="option">
            <?php 
  if (!isset($_SESSION['userid'])) {
     echo "<p><a href='login.php'>Log in</a></p>";
}
       ?>
                <!-- <p class="mode" id="toggle-button" >
                    <span id="moon" >
                    <i class="fa fa-moon"></i></span>
                <span id="light">Light Mode</span></p> -->
            </div>
        </div>
        </div>
    <script src="dashboard.js"></script>