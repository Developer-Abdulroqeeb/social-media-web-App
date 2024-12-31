<?php
include "config.php";
if(isset($_POST['submit'])){
   $verify = $_POST['verify'];
    if( isset($_SESSION['otp']) && $_SESSION['otp'] != $verify){
        $otp_incorrect = 'OTP is incorrect';
    }
    else{
        header('Location: changepassword.php');
    }
} 
// ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="image/tb_logo.webp" type="image/x-icon">
    <link rel="stylesheet" href="styl.css">
    <title>Verify TickleByte </title>

   <style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Prata&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap');

</style>
</head>
<body>

    <div id="container" class="container">
        <div class="signup_content">
        <div class="tickle_logo">   
           <img src="image/tb_logo.webp" alt="">
           <h1>TickleByte</h1>
           </div> 
        <div class="subcontainer">
        <?php if(isset($_SESSION['email'])) { ?>  <p style="text-align:center; font-size:13px; color:#8B5E3C;">OTP has been sent to
      <?php echo(htmlspecialchars($_SESSION['email'])) ?>    </p>   <?php } ?>
        <form  id="form" method="post">
            <div class="label_input">
            <label for="username">Enter OTP</label>
            <input type="number" Placeholder='Verify OTP' name="verify" id="">
        <?php if(isset($otp_incorrect)) { ?> <p style="font-size:10px; color:red;">
            <?php echo $otp_incorrect;  ?>
        </p><?php } ?>
</div>
         <button type="submit" style="background:#8B5E3C; color:white;" name="submit">Verify</button>
        </form> 
    </div>
    </div>
    </div>
    <script>

        </script>
        <?php   ?>
</body>
</html>