<?php
// Include calendar helper functions
include_once 'functions.php';

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

    <title>NITC GH</title>
  </head>
  <body>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

      <header class="page-header" id="header">
      <div class="container-fluid" >
 <a class="admin_login"  onclick="document.getElementById('login_modal').style.display='block'" style="float:right;">Admin Login</a>
          <div class="row">
    <div class="col-sm-6">
     <img  src="images/logo.jpg">
    </div>
    <div class="col-sm-6" >

      <h3 style="color:#23aacc; float:right;">GUEST HOUSE BOOKING PORTAL</h3>
    </div>
  </div>

           </div>
      </header>

 <!----------------------Admin Login---------------------->
      <?php


   { include("dbConfig.php");

   session_start();
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form

      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']);

      $sql = "SELECT id FROM admin WHERE username = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

      $count = mysqli_num_rows($result);

      // If result matched $myusername and $mypassword, table row must be 1 row

      if($count == 1) {

         $_SESSION['login_user'] = $myusername;

         header("location: admin.php");
      }else {
          $_SESSION["error"] = "Wrong Username/Password";
      }
   }}
?>
      <div id="login_modal" class="modal">

  <form class="modal-content animate"  method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('login_modal').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="images/admin.jpeg" alt="Avatar" class="avatar">
    </div>

    <div class="container" >
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

    <div class="container" >

      <span class="psw"> <a href="#"> Forgot password?</a></span>
    </div>
  </form>
</div>
<script>
// Get the modal
var modal = document.getElementById('login_modal');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>


      <div id="main">
       <div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <img src="images/nitc1.jpeg" style="height:400px ;width: 100%" alt="NITC">
    </div>

    <div class="item">
      <img src="images/nitc2.jpeg" style="height:400px ;width: 100%" alt="NITC">
    </div>

    <div class="item">
      <img src="images/nitc3.jpeg" style="height:400px ;width: 100%" alt="NITC">
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>
</div>



     <div class=".container-fluid">
         <div style=" margin-top:25px;" align="center">
         <a class="example_f" href="#displaycalendar" >
             <span align="center" style="width: 90%;">CHECK AVAILABILITY</span>
         </a>
         </div>

    </div>

          </div>

      <div class="row" id="displaycalendar">

          <?php

          echo getCalender(); ?>

      </div>
<div class=".container-fluid">
         <div style=" margin-top:25px;" align="center">            <a class="example_f" href="user.php" >
             <span align="center" style="width: 90%;">BOOK NOW</span>
          </a>
         </div>

    </div>


  </body>
</html>

