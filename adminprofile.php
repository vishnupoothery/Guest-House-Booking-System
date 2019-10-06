<?php
   include('session.php');

    include('header.php');


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
   <link rel="stylesheet" href="css/mystyles.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
      <script src="js/myjs.js"></script>

    <title>NITC GH</title>
  </head>
<body class="w3-light-grey">
  <?php echo display_header(); ?>

  <div class="container" style="margin=0px;">
<ul class="nav nav-tabs">
    <li><a  href="admin.php">HOME</a></li>
    <li><a   href="upcomingbookings_admin.php">UPCOMING BOOKINGS</a></li>
    <li><a   href="past_bookings_admin.php">PAST BOOKINGS</a></li>
    <li><a class="active"  href="rooms.php">ROOMS</a></li>
       <li><div class="dropdown"><a class="dropdown-toggle"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   <span class= "glyphicon glyphicon-user" style="color:blue;"></span>
  </a>
  <div  class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="adminprofile.php">My Profile</a>
    <a class="dropdown-item" href="addadmin.php">Add Admin</a>
    <a class="dropdown-item" href="logout.php">Sign Out</a>
  </div></div> </li>
  </ul>
<br>
 <div class="tab-content">
    <div  class="tab-pane fade in active">

        <?php
        if (isset($_POST['changepassword_button']))
        {

        include 'dbConfig.php';
        $username=$_SESSION['login_user'];
        $password = $_POST['password'];
        $newpassword = $_POST['newpassword'];
        $confirmnewpassword = $_POST['confirmnewpassword'];
        $result = mysqli_query($db,"SELECT password FROM admin WHERE
username='".$username."'");

        if(!$result)
            echo "The username you entered does not exist";
        else
        {
         $res= mysqli_fetch_assoc($result);
        if ($password != $res['password'])
            echo "You entered an incorrect password";

        else if($newpassword=$confirmnewpassword)
        {
            $sql=mysqli_query($db,"UPDATE admin SET password='$newpassword' where
            username='$username'");
            if($sql)
                echo "Congratulations You have successfully changed your password";

        }
       else
        echo "Passwords do not match";

        }
        }
        ?>

          <form method="post" action="adminprofile.php">
        <div class="container" >
      <label><b>Current Password</b></label>
      <input type="password"  name="password" required>

      <label><b>New Password</b></label>
      <input type="password" name="newpassword" required>
        <label ><b>Confirm New Password</b></label><br>
        <input type="password"  name="confirmnewpassword" required><br> <br>
            <button type="submit" name="changepassword_button" class="btn btn-primary">Change</button>
            </div>
        </form>
         </div>
      </div>
    </div>
    </body>
</html>
