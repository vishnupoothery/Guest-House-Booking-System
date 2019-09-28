
<?php
// Include calendar helper functions
include_once 'functions.php';
include('header.php');
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
 <?php echo display_header(); ?>

<nav class="navbar navbar-default"><ul class="nav nav-bar">
    <li ><a href="checkAvailability.php">HOME</a></li>
    <li><a class="active" href="upcomingbookings_user.php">UPCOMING BOOKINGS</a></li>
    <li><a href="#menu2">PAST BOOKINGS</a></li>
    <li><a href="#menu3">GUIDELINES</a></li>
  </ul>
        </nav>

      <?php

      include('dbConfig.php');
      $sql="SELECT `booking_id`,'booking_date','booking_status' FROM booked INNER JOIN guests USING(booking_id) WHERE checkin>DATE_FORMAT(now(),'%Y%c%d') GROUP BY 'booking_id'
";// and booked_by=user_id;
      $result = mysqli_query($db,$sql);
      echo "<table class='table table-hover'> <tr><th>BOOKING DATE </th><th>  BOOKING STATUS</th></tr>";
       if($result)
       {
            while($rr=mysqli_fetch_array($result))
            {
                echo "<tr><td colspan=2><div class='accordion' id='".$rr['booking_id']."'>
  <div class='card'>
    <div class='card-header' id='heading";
                echo $rr['booking_id'];
                echo "'>
      <h2 class='mb-0'>
        <button class='btn btn-link' type='button' data-toggle='collapse' data-target='#collapse";
                echo $rr['booking_id'];
                echo "' aria-expanded='true' aria-controls='collapse";
                echo $rr['booking_id'];
                echo "'>";
                echo $rr['booking_date'];
echo "title";

    $sql_sub="SELECT * FROM rooms INNER JOIN guests WHERE booking_id='".$rr['booking_id']."'";
    $result_sub=mysqli_query($db,$sql_sub);

 echo "</button>
      </h2>
    </div></td><tr><td colspan=2>

    <div id='collapse";
                echo $rr['booking_id'];
                echo "' class='collapse' aria-labelledby='heading";
    echo $rr['booking_id'];
    echo "' data-parent='#".$rr['booking_id']."'>
      <div class='card-body'>
       guest details
      </div>
    </div>
  </div></td></tr>";

            }

       }
      echo "</table>";

      ?>


    </body>
</html>
