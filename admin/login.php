<?php
// Include calendar helper functions
include '../header.php';

?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/mystyles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <title>NITC GH</title>
</head>

<body>
    <?php echo display_header();
      ?>




    <!----------------------Admin Login---------------------->
    <?php


   { include("dbConfig.php");

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form

      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']);

      $sql = "SELECT id,password FROM admin WHERE username = '$myusername'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

      $count = mysqli_num_rows($result);

      // If result matched $myusername and $mypassword, table row must be 1 row

   session_start();
      if($count == 1 && password_verify($_POST['password'], $row['password'])) {

         $_SESSION['login_user'] = $myusername;

         header("location: admin.php");
      }else {
          $_SESSION["error"] = "Wrong Username/Password";
      ?>
    <script>$(window).on('load', function () {
            $('#login_modal').css('display', 'block');
        });</script> <?php
      }
   }}
?>
    <div id="login_modal_" class="_modal">

        <form class="modal-content animate" method="post">
            <div class="imgcontainer">
                <span onclick="document.getElementById('login_modal').style.display='none'" class="close"
                    title="Close Modal">&times;</span>
                <img src="images/admin.jpeg" alt="Avatar" class="avatar">
            </div>

            <div class="container">
                <label for="uname"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="username" required>

                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" required>
                <?php
                    if(isset($_SESSION["error"])){
                        $error = $_SESSION["error"];
                        echo '<span style="color:red;">';echo $error; echo '</span>';
                        unset($_SESSION["error"]);
                    }
                ?>
                <button type="submit" id="adminloginbtn" class="login_button">Login</button>


            </div>

            <div class="container">

                <span class="psw"> <a href="#"> Forgot password?</a></span>
            </div>
        </form>
    </div>

    


</body>

</html>