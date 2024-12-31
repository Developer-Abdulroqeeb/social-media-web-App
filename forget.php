<?php
include "config.php";
// ?>

<?php
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;

 require 'PHPMailer/src/Exception.php';
 require 'PHPMailer/src/PHPMailer.php';
 require 'PHPMailer/src/SMTP.php';

if(isset($_POST['submit'])){
  $otp = mt_rand(1000,9999);
  $_SESSION['forgetotp'] = $otp;
//   $user = $_SESSION['userid'];
  $verify_mail = $_POST['verify_mail'];
$selct = mysqli_query($connection,"SELECT * FROM user WHERE email='$verify_mail'");
// $row = mysqli_fetch_array($selct);
while($row = mysqli_fetch_array($selct)){
    $_SESSION['usermailid'] =  $row['id'];
}
// echo $_SESSION['usermailid'];
if($selct && mysqli_num_rows($selct)>0){
 
    function sendOtpEmail($verify_mail,$otp){  
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
        $mail->addAddress($verify_mail); 
        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = "TickleByte Media" ;
        $mail->Body    ="HI your OTP is".$otp;
    //    senfing mail
    $mail->send();
        echo "Email sent successfully t0.".$verify_mail;
    } catch (Exception $e)  {
        echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }   
    
    header("Location: verifyforget.php");
 
//     echo "<script> location.href='verifyforget.php' </script>";
//    $_SESSION['mailid'] =$_SESSION['usermailid'] ;
   }
   sendOtpEmail($verify_mail,$otp);
}else{
    $error = "Email doesnt exist";
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
     <p style="text-align:center; font-size:13px; color:#8B5E3C;">
    
        <form  id="form" method="post">
            <div class="label_input">
        <?php
 if(isset($error)){
    echo $error;
 }

?>
            <label for="username">Enter Mail</label>
            <input type="email"  Placeholder='Enter your Gmail' name="verify_mail" id="">
       <p style="font-size:10px; color:red;">
        </p>
</div>
         <button type="submit" style="background:#8B5E3C; color:white;" name="submit">Request OTP</button>
        </form> 
    </div>
    </div>
    </div>
</body>
</html>