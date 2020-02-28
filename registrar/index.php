<?php
include 'header.php';
include 'dbConfig.php';
if (isset($_SESSION['admin'])) {
    header('location: home.php');
  }

?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/mystyles.css">
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <title>NITC GH</title>
</head>

<body>
    <?php echo display_header(); 

    if($_SERVER["REQUEST_METHOD"] == "POST") 
    {
      // username and password sent from form

      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']);

      $sql = "SELECT id,password FROM registrar WHERE username = '$myusername'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result);
      $count = mysqli_num_rows($result);

      // If result matched $myusername and $mypassword, table row must be 1 row

      session_start();

      if($count == 1 && password_verify($_POST['password'], $row['password']))
       {
        $_SESSION['admin'] = $myusername;
        header("location: home.php");
      }
      else {
          $_SESSION["error"] = "Wrong Username/Password";
      ?>
    <script>$(window).on('load', function () {
            $('#login_modal').css('display', 'block');
        });</script> <?php
      }
   }
?>
    <div id="login_modal_" class="_modal">

        <form class="modal-content animate" method="post">
            <div class="imgcontainer">
                        <img src="../images/admin.jpeg" alt="Avatar" class="avatar">
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