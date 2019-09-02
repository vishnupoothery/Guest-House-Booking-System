
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

    <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/mystyles.css">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open Sans">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"> </script>
    <script src="js/jquery.min.js"></script>
      <script src="js/myjs.js"></script>

      <script>
  $(function() {
    $( "#skills" ).autocomplete({
      source: 'search.php'
    });
  });
  </script>
    <?php include_once('functions.php'); ?>



    <title>NITC GH</title>



  </head>
  <body class="w3-light-grey">
    <header class="page-header" id="header">
      <div class="container-fluid" style="padding-top: 0px">

          <div class="row">
    <div class="col-sm-6">
     <img  src="images/logo.jpg">
    </div>
    <div class="col-sm-6" >
      <h3 style="color:#23aacc; float:right;"><a href=index.php style="text-decoration:none;">GUEST HOUSE BOOKING PORTAL</a></h3>
    </div>
  </div>
     </div>


      </header>
<div class="container" style="margin=0px;">

  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">HOME</a></li>
    <li><a data-toggle="tab" href="#menu1">UPCOMING BOOKINGS</a></li>
    <li><a data-toggle="tab" href="#menu2">PAST BOOKINGS</a></li>
    <li><a data-toggle="tab" href="#menu3">GUIDELINES</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
     <div class="row">
      <div class="col-sm-7" >
        <div id="calendar_div">
            <?php echo getCalender(); ?>
        </div>
    </div>
    <div class="col-sm-4" style="paddingRight:10px;">
        <form action="/action_page.php" style="padding:120px 0;" onsubmit="return validateForm()" id="form">
  <div class="form-group">
    <label for="checkin">CHECK-IN</label>
    <input type="date" class="form-control" id="checkin" required>
  </div>
  <div class="form-group">
    <label for="checkout">CHECK-OUT</label>
    <input type="date" class="form-control" id="checkout" required>
  </div>
  <div class="form-group">
    <label for="number">Number of Guests</label>
    <input type="number" class="form-control" id="num" required>
  </div>
  <button type="submit" class="btn btn-primary" >Submit</button>
</form>

    </div>
</div>
    </div>
    <div id="menu1" class="tab-pane fade">
      <h3>Upcoming</h3>
    </div>
    <div id="menu2" class="tab-pane fade">
      <h3>Past</h3>
    </div>
    <div id="menu3" class="tab-pane fade">
      <h3>FAQ</h3>
    </div>
  </div>
</div>








</body>
</html>

