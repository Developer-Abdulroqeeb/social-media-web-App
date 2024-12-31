<?php
include "config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
 
 *{
    padding:0;
    margin:0;
 }
 body{
   
    background:whitesmoke;
 }
        </style>
</head>
<body>
<?php
if(isset($_POST['edit'])){
    $name = $_POST['name'];
    $email = $_POST['edit_mail'];
    $password = $_POST['edit_password'];
    
    if ($_FILES['profile_image']['name'] != "") {
      // Get the current profile image from the database for deletion
      $query = mysqli_query($connection, "SELECT profile_image FROM user WHERE id='" . $_SESSION['userid'] . "'");
      $row = mysqli_fetch_assoc($query);
      $old_profile_image = $row['profile_image'];

            // Path to the old profile image
            $old_image_path = "image/" . $old_profile_image;
                // Check if the old image exists and delete it
      if (file_exists($old_image_path)) {
        unlink($old_image_path);  // Delete the old image from the server
    }
            // Upload the new profile image
            $profile_image = basename($_FILES["profile_image"]["name"]);
            $target_file = "image/" . $profile_image;
    }
    if( move_uploaded_file($_FILES["profile_image"]["tmp_name"],$target_file)){
      $update = mysqli_query($connection,"UPDATE user SET
      username='$name',
      email='$email',
      password='$password',
      profile_image	 = '$profile_image'
      WHERE id='".$_SESSION['userid']."' ");
    }
    else{
      $update = mysqli_query($connection, "UPDATE user SET
      username='$name',
      email='$email',
      password='$password'
      WHERE id='" . $_SESSION['userid'] . "'");
    
    }
    if($update){
      echo "<script> location.href='profile.php'</script>";
   }else{
      echo "Error".$update.mysqli_error($connection);
   }
}
     



?>
  <p style="background:#8B5E3C; color: white; font-family:san-serif; padding:20px;">Edit Profile</p>

    <form action="" method="post" style=""  enctype="multipart/form-data">
    <div style="padding:20px;  display:flex; gap:20px; flex-direction:column;">
        <?php
        $user_id = $_SESSION['userid'];
        $edit_query = mysqli_query($connection,"SELECT * FROM user WHERE id = '$user_id'");
        while($row =  mysqli_fetch_array($edit_query)){
        ?>
        <div class="profil_pics">
 <img src="image/icon2.png" style="width:10%; border-radius:50%;">
            <input type="file" name="profile_image" accept="image/*">
        </div>
        <div style="background:white; width:60%; align-items:center; gap:10px; display:flex; padding:10px; ">
        <p>Username:</p>
      <input type="text" style="width:100%; padding:10px; border-radius:10px;"  name="name" value="<?php echo $row['username'];   ?>" id=""> 
        </div>
        <div style="background:white; width:60%; align-items:center; gap:10px; display:flex; padding:10px; ">
        <p>Email:</p>
      <input type="email" style="width:100%; padding:10px; border-radius:10px;"  name="edit_mail" value="<?php echo $row['email'];   ?>" id=""> 
        </div>
        <div style="background:white; width:60%; align-items:center; gap:10px; display:flex; padding:10px; ">
        <p>password:</p>
      <input type="text" style="width:100%; padding:10px; border-radius:10px;" name="edit_password" value="<?php echo $row['password'];   ?>" id=""> 
        </div>
      <?php } ?>
      </div>
      <center><button style="padding:10px; border:0; width:10vw; border-radius:10px; 
      color:white; background:#8B5E3C; " type="submit" name="edit">Save</button>
        </center>
        </form>
     <script>
             const image=document.querySelector("img");
 input = document.querySelector("input");
 input.addEventListener("change", ()=>{
     image.src=URL.createObjectURL(input.files[0]);
 });
     </script>
</body>
</html>