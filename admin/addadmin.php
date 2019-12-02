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
      if (isset($_POST['addadmin_button'])) {
        include('dbConfig.php');
        $sql = "INSERT INTO admin (username,password,email) VALUES ('" . $_POST['username'] . "','" . password_hash($_POST['password'], PASSWORD_BCRYPT) . "','" . $_POST['email'] . "')";


        if (mysqli_query($db, $sql) == TRUE) {
          echo "<div class='alert alert-success alert-dismissible'>
      <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>

  <strong>Success!</strong> New Admin Added!
</div>";
        } else {
          //echo $db->error;;
          echo "<div class='alert alert-warning alert-dismissible'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>

  <strong>Error!</strong> New Admin not Added.
</div>
";
        }
        unset($_POST['addadmin_button']);
      }
      ?>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-5">
            <form method="post" action="addadmin.php">

              <label for="uname"><b>Username</b></label><br>
              <input type="text" placeholder="Enter Username" name="username" required><br>
              <label for="psw"><b>Password</b></label><br>
              <input type="password" placeholder="Enter Password" name="password" required><br>
              <label for="email"><b>Email</b></label><br>
              <input type="email" placeholder="Enter Email" name="email" required><br> <br>
              <button type="submit" name="addadmin_button" class="btn btn-primary">Add</button>
            </form>
          </div>
        </div>
      </div>

    </div>

</body>

</html>