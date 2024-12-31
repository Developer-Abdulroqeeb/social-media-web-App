<?php
include "config.php";
if(isset($_POST['submit'])){
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    // $select = mysqli_query($connection,'SELECT * FROM user WHERE id = " $_SESSION['id']" ');

$user = $_SESSION['usermailid'] ;

    if($password == $cpassword){
        $update = mysqli_query($connection,"UPDATE user SET password ='$cpassword' WHERE id='$user' ");
        if($update){
            header("Location:login.php");
        }
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
    <title>change password</title>

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
           <?php echo $_SESSION['usermailid'];  ?>
           </div> 
        <div class="subcontainer">
        
        <form  id="form" method="post">
            <p id="error" style="font-size:15px; color:red; "></p>
            <div class="label_input">
            <label for="username">New Password</label>
            <input type="password" id="password" Placeholder='New password' name="password" id="">
</div>
<div class="label_input">
            <label for="username">Confirm Password</label>
            <input type="password"  id="cpassword" Placeholder='Confirm password' name="cpassword" id="">
       
</div>
         <button type="submit" style="background:#8B5E3C; color:white;" name="submit">Verify</button>
        </form> 
    </div>
    </div>
    </div>
    <script>
const password = document.getElementById("password");
const cpassword = document.getElementById("cpassword");
const error = document.getElementById("error");
const form= document.getElementById("form");
  form.addEventListener('submit', function(e){
   if(password.value != cpassword.value){
  e.preventDefault();
   error.innerHTML = "Password doesnt match";
   } 
   https://colorlib.com/polygon/nalika/index.html
  });
        </script>
</body>
</html>