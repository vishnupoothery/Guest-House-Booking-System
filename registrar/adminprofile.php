<?php
include('session.php');
include('header.php');


?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/mystyles.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/jquery.min.js"></script>
  <script src="../js/myjs.js"></script>
  <title>NITC GH</title>
</head>

<body>
  <?php echo display_header();
  echo display_admin_navbar(); ?>


  <br>
  <div class="tab-content">

    <?php
    if (isset($_POST['changepassword_button'])) {

      include 'dbConfig.php';
      $username = $_SESSION['login_user'];
      $password = $_POST['password'];
      $newpassword = $_POST['newpassword'];
      $confirmnewpassword = $_POST['confirmnewpassword'];
      $result = mysqli_query($db, "SELECT password FROM admin WHERE
username='" . $username . "'");

      if (!$result)
        echo "The username you entered does not exist";
      else {
        $res = mysqli_fetch_assoc($result);
        if ($password != $res['password'])
          echo "You entered an incorrect password";

        else if ($newpassword = $confirmnewpassword) {
          $sql = mysqli_query($db, "UPDATE registrar SET password='$newpassword' where
            username='$username'");
          if ($sql)
            echo "Congratulations You have successfully changed your password";
        } else
          echo "Passwords do not match";
      }
    }
    ?>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-5">
          <form method="post" action="adminprofile.php">
            <label><b>Current Password</b></label><br>
            <input type="password" name="password" required><br>
            <label><b>New Password</b></label><br>
            <input type="password" name="newpassword" required><br>
            <label><b>Confirm New Password</b></label><br>
            <input type="password" name="confirmnewpassword" required><br> <br>
            <button type="submit" name="changepassword_button" class="btn btn-primary">Change</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>