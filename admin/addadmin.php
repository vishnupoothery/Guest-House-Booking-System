<?php
   include('session.php');

    include('../header.php');


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
   <link rel="stylesheet" href="../css/mystyles.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
      <script src="../js/myjs.js"></script>

    <title>NITC GH</title>
  </head>
<body class="w3-light-grey">
  <?php echo display_header();
    echo display_admin_navbar(); ?>
<br>
 <div class="tab-content">
    <div  class="tab-pane fade in active">
        <?php
        if (isset($_POST['addadmin_button']))
        {
            include('dbConfig.php');
            $sql="INSERT INTO admin (username,password,email) VALUES ('".$_POST['username']."','".password_hash($_POST['password'], PASSWORD_BCRYPT)."','".$_POST['email']."')";


        if (mysqli_query($db,$sql) == TRUE) {
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
" ;
}
        }
        ?>

        <form method="post" action="addadmin.php">
        <div class="container" >
      <label for="uname"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="username" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="password" required>
        <label for="email"><b>Email</b></label><br>
        <input type="email"  placeholder="Enter Email" name="email" required><br> <br>
            <button type="submit" name="addadmin_button" class="btn btn-primary">Add</button>
            </div>
        </form>
     </div>
      </div>
    </div>
    </body>
</html>
