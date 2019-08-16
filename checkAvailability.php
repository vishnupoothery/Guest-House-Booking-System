
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

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open Sans">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js">
    </script>
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
      <div class="container-fluid" style="padding-top: 30px">

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






</body>
</html>

