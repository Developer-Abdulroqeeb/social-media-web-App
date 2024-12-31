<?php
include 'config.php';
  if(isset($_POST['submit'])){
   $mail = mysqli_real_escape_string($connection,$_POST['mail']);
   $cpassword = mysqli_real_escape_string($connection,$_POST['cpassword']);
   
   $confirm = "SELECT * FROM user WHERE email ='$mail'";
   $result = mysqli_query($connection,$confirm);
   if($result && mysqli_num_rows($result)>0){
    $row = mysqli_fetch_array($result);
    if($row['password'] === $cpassword ){
        $_SESSION['userid'] = $row['id'];
        header('Location: index.php');
    }else{
        $log_confirm = "incorrect password"; 
    } 
   }else{
    $log_confirm = "Cant't Log in due to incorrect inputs";
   }

  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="image/tb_logo.webp" type="image/x-icon">
    <link rel="stylesheet" href="styl.css">
    <title>Log in TickleByte </title>

   <style>
    .forget{
        text-align:right; 
    }
   .forget a{ 
    text-align:center; 
    color:black;
     text-decoration:none;
   }
@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Prata&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap');
</style>
</head>
<body>
    <div class="container">
        <div class="signup_content">
        <div class="tickle_logo">   
           <img src="image/tb_logo.webp" alt="">
           <h1>TickleByte</h1>
           </div> 
        <div class="subcontainer">
            <p style="text-align:center; color:#8B5E3C;">Log in on TickleByte Media</p>   
        <form action="" method="post">
            <?php if(isset($log_confirm)){ ?>  <p style="font-size:10px; text-align:center; color:red; "><?php echo $log_confirm ;   ?></p> <?php } ?>
            <div class="label_input">
            <label for="username">Email Address</label>
            <input type="email" Placeholder='Enter your Gmail' name="mail" id="">
</div>
<div class="label_input">
            <label for="username">Password</label>
            <input type="password" name="cpassword" Placeholder="Password" id="">
</div>

         <button type="submit" style="background:#8B5E3C; color:white;" name="submit">Log in</button>
        </form> 
       <p class="forget"><a href="forget.php">Forgot password?</a></p>
    </div>
    <p style="text-align:center;">  Don't have an account ? <a href="signup.php" style="color:#8B5E3C;">Register</a></p>
    </div>
    </div>
</body>
</html>