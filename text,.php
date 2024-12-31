<?php

if (isset($_POST['edit'])) {
  $name = $_POST['name'];
  $email = $_POST['edit_mail'];
  $password = $_POST['edit_password'];

  // If the user uploaded a new profile image
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

      if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
          // Image uploaded successfully, now update the database
          $update = mysqli_query($connection, "UPDATE user SET
              username='$name',
              email='$email',
              password='$password',
              profile_image='$profile_image'
              WHERE id='" . $_SESSION['userid'] . "'");
      }
  } else {
      // If no new image was uploaded, just update the other details
      $update = mysqli_query($connection, "UPDATE user SET
          username='$name',
          email='$email',
          password='$password'
          WHERE id='" . $_SESSION['userid'] . "'");
  }
}


?>
