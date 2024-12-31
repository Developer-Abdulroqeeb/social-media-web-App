<?php
 include "config.php";
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;

 require 'PHPMailer/src/Exception.php';
 require 'PHPMailer/src/PHPMailer.php';
 require 'PHPMailer/src/SMTP.php';
 
if($_SERVER['REQUEST_METHOD']=="POST"){
    
    // otp verification
    $otp = mt_rand(1000,9999);
     $_SESSION['otp'] = $otp;
     $profile_image	 = basename($_FILES["profile_image"]["name"]);
     $target_dir = "image/";
     $target_file = $target_dir. basename($_FILES["profile_image"]["name"]);
     if( move_uploaded_file($_FILES["profile_image"]["tmp_name"],$target_file)){
     }
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $profile_image = $_POST['profile_image'];
    $_SESSION['email'] = $_POST['email'];

    $slect = "SELECT * FROM user where email='$email' OR username='$username'";
    $select_query = mysqli_query($connection,$slect);
    if(mysqli_num_rows($select_query)>0){
        $erromsg = 'Email or Username Already Exist'; 
}else{
    $query = "INSERT INTO user (username,email,password,profile_image) VALUES ('$username','$email','$password','$profile_image')";
    $result = mysqli_query($connection,$query);
    if($result){
        function sendOtpEmail($email,$otp){  
            $mail = new PHPMailer(true);
        try {
           
            // SMTP settings
            $mail->isSMTP(); // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com'; // Your SMTP server (e.g., smtp.gmail.com)
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->Username = 'testmemail2003@gmail.com'; //t Your email address
            $mail->Password = 'hsxwmbptncvzqmhf'; // Your email password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Enable TLS encryption
            $mail->Port = 465; // TCP port to connect to
            // Recipients
            $mail->setFrom('testmemail2003@gmail.com', 'TickleByte Media'); // Your email and name
            $mail->addAddress($email); 
            // Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = "TickleByte Media" ;
            $mail->Body    = 'Hi'."  ".$username." You have succesfully Register on TickleByte Media to Enjoy the Latest trends,Videos and Amazing Contents  Enter ".$otp." to complete your Registration.";
        //    senfing mail
        $mail->send();
            echo "Email sent successfully to .";
        } catch (Exception $e)  {
            echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }   
        
        header("Location: verification.php");
       }
       sendOtpEmail($email,$otp);
    }
}
}
// anafiazeez890@gmail.com
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="image/tb_logo.webp" type="image/x-icon">
    <link rel="stylesheet" href="styl.css">
    <title>Sign Up TickleByte </title>

   <style>
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
            <p style="text-align:center; color:#8B5E3C;">Register on TickleByte Media</p>    
        <form  id="form" method="POST">
            <div class="label_input">
            <?php if(isset($erromsg)){?>  <p style="color:red; font-size:10px;"><?php echo $erromsg;  ?></p> <?php } ?>
         <input type="file" name="profile_image" style="display:none;">
            <label for="username">Username</label>
            <input type="text" Placeholder="Username" name="username" id="username">
            <p id="required" style="font-size:10px;"></p>
            </div>
            <div class="label_input">
            <label for="">Email Address</label>
            <input type="email" Placeholder='Enter your Gmail' name="email" id="email">
            <p id="email_require" style="font-size:10px;"></p>
</div>
<div class="label_input">
            <label for="">Password</label>
            <input type="password" name="password" Placeholder="Password" id="password">
            <p id="password_require" style="font-size:10px;"></p>
</div>    
<div class="label_input">
            <label for="username">Confirm Password</label>
            <input type="password" placeholder='Confirm password' name="cpassword" id="cpassword">
            <p id="error" style="font-size:10px;"></p>
            <p id="cpassword_require" style="font-size:10px;"></p>
</div>
            <button type="submit" id="submit" disabled >Register</button>
        </form>
      
    </div>
    <p style="text-align:center;">Already have an account ? <a href="login.php" style="color:#8B5E3C;">Log in</a></p>
    </div>
    </div>
    <script src="tickl.js"></script>
    
</body>
</html>