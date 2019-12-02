<?php

include_once 'functions.php'; // Include calendar helper functions
include 'header.php';
require_once 'config.php';


if (isset($_SESSION['userData'])) {
  header('location: user.php');
}

$loginURL = "";
$authUrl = $googleClient->createAuthUrl();
$loginURL = filter_var($authUrl, FILTER_SANITIZE_URL);
?>


<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/mystyles.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <title>NITC GH</title>
</head>

<body>
  <?php echo display_header(); ?>
  <div id="main">
    <div class="container-fluid">

      <div class="row justify-content-center">
        <div class="col">
          <div id="caraousel" class="carousel slide" data-ride="carousel">

            <!-- Indicators -->
            <ul class="carousel-indicators">
              <li data-target="#caraousel" data-slide-to="0" class="active"></li>
              <li data-target="#caraousel" data-slide-to="1"></li>
              <li data-target="#caraousel" data-slide-to="2"></li>
            </ul>

            <!-- The slideshow -->
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="images\nitc1.jpeg" class="carouselImg" alt="Picture Unavailable">
              </div>
              <div class="carousel-item">
                <img src="images\nitc2.jpeg" class="carouselImg" alt="Picture Unavailable">
              </div>
              <div class="carousel-item">
                <img src="images\nitc3.jpeg" class="carouselImg" alt="Picture Unavailable">
              </div>
            </div>

            <!-- Left and right controls -->
            <a class="carousel-control-prev" href="#caraousel" data-slide="prev">
              <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#caraousel" data-slide="next">
              <span class="carousel-control-next-icon"></span>
            </a>

          </div>
        </div>
      </div> <br>

      <div class="row justify-content-center">
        <a class="homeBtn" href="#showavailability">
          <span>CHECK AVAILABILITY</span>
        </a>
      </div> <br>

      
      <div class="row justify-content-center" id="showavailability">
        <div id="calendar_div" class="col">
          <?php echo getCalender(); ?>
        </div>
      </div> <br>

      <?php
      if (isset($_SESSION['wrongemail']))
      {

        session_destroy();
        echo "<div class='alert alert-danger' role='alert'>
       Please login using <b> NIT-C email id</b>
      </div>";
      
      }
      ?>

      <div class=" row justify-content-center">
        <a class="homeBtn" href="<?= htmlspecialchars($loginURL); ?>">
          <span>BOOK NOW</span>
        </a>
      </div>
    </div>

</body>

</html>