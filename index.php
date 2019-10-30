<?php
// Include calendar helper functions
include_once 'functions.php';
include 'header.php';
?>
<?php
require_once 'config.php';
if(isset($_SESSION['userData'])){
	header('location: user.php');
}
$loginURL="";
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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/mystyles.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <title>NITC GH</title>
</head>

<body>
  <?php echo display_header();
      ?>
  <script>
    // Get the modal
    var modal = document.getElementById('login_modal');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
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
        <a class="example_f" href="#showavailability">
          <span align="center" style="width: 90%;">CHECK AVAILABILITY</span>
        </a>
      </div>

    </div>

  </div>
  <br>
  <div class="row" id="showavailability">
    <div class='col-sm-3'></div>

    <div id="calendar_div" class="col-sm-6">
      <?php echo getCalender(); ?>
    </div>

  </div>
  <div class=".container-fluid">
    <div style=" margin-top:25px;" align="center"> <a class="example_f" href="<?= htmlspecialchars( $loginURL ); ?>">
        <span align="center" style="width: 90%;">BOOK NOW</span>
      </a>
    </div>

  </div>


</body>

</html>