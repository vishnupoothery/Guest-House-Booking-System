          <?php
// Include calendar helper functions
include_once 'functions.php';
include 'header.php';

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
<?php echo display_header();
      ?>




 <!----------------------Admin Login---------------------->
      <?php


   { include("dbConfig.php");

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form

      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']);

      $sql = "SELECT id FROM admin WHERE username = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

      $count = mysqli_num_rows($result);

      // If result matched $myusername and $mypassword, table row must be 1 row

   session_start();
      if($count == 1) {

         $_SESSION['login_user'] = $myusername;

         header("location: admin.php");
      }else {
          $_SESSION["error"] = "Wrong Username/Password";
      ?> <script>$(window).on('load',function(){
        $('#login_modal').css('display','block');
    });</script> <?php
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
         <a class="example_f" href="#showavailability" >
             <span align="center" style="width: 90%;">CHECK AVAILABILITY</span>
         </a>
         </div>

    </div>

          </div>
<br>
      <div class="row" id="showavailability">
          <div class='col-sm-3'></div>

     <div id="calendar_div" class="col-sm-6"  >
            <?php echo getCalender(); ?>
        </div>

      </div>
<div class=".container-fluid">
         <div style=" margin-top:25px;" align="center">            <a class="example_f" href="user.php" >
             <span align="center" style="width: 90%;">BOOK NOW</span>
          </a>
         </div>

    </div>


  </body>
</html>

