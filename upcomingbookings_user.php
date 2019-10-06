
<?php

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
    <li ><a href="user.php">HOME</a></li>
    <li><a class="active" href="upcomingbookings_user.php">UPCOMING BOOKINGS</a></li>
    <li><a href="past_bookings.php">PAST BOOKINGS</a></li>
    <li><a href="#menu3">GUIDELINES</a></li>
  </ul>
        </nav>

      <?php

      include('dbConfig.php');
      $sql="SELECT DISTINCT `booking_id` FROM guests WHERE checkin>DATE_FORMAT(now(),'%Y%c%d') AND room_id!=-1
";// and booked_by=user_id;

      $result = mysqli_query($db,$sql);
      echo "<table class='table table-hover'> <tr><th>BOOKING DATE </th><th>CHECKIN</th><th>CHECKOUT</th><th>  BOOKING STATUS</th></tr>";
       if($result)
       {
            while($rr=mysqli_fetch_array($result))
            {   $get_booking_data="SELECT DATE_FORMAT(booking_date,'%d-%m-%y') as booking_date,booking_status FROM booked WHERE booking_id=".$rr['booking_id']."";
                $booking_data_res= mysqli_query($db,$get_booking_data);
                $booking_data=mysqli_fetch_assoc($booking_data_res);
             $get_guest_data="SELECT DATE_FORMAT(checkin,'%d-%m-%y') as checkin,DATE_FORMAT(checkout,'%d-%m-%y') as checkout FROM guests WHERE booking_id=".$rr['booking_id']."";
             $guest_data_res=mysqli_query($db,$get_guest_data);
             $guest_data=mysqli_fetch_assoc($guest_data_res);
                echo "<tr class='collapserow' onclick='toggle_collapse(";
                echo $rr['booking_id'];
                echo ")'><td>";
                echo $booking_data['booking_date'];
             echo "</td><td>";
             echo $guest_data['checkin'];
             echo "</td><td>";
             echo $guest_data['checkout'];
             echo "</td><td>";
             echo $booking_data['booking_status'];
             echo "</td></tr><tr id='collapse";
             echo $rr['booking_id'];
             echo "' class='collapse out'><td colspan=4>";

             $get_guest_data="SELECT * FROM guests WHERE booking_id=".$rr['booking_id']."";
             $guest_data_res=mysqli_query($db,$get_guest_data);

             echo "<table class='table'>";
             while($guest_data=mysqli_fetch_array($guest_data_res))
             {
                 echo "<tr><td>";
                 echo $guest_data['name'];
                 echo "</td><td>";
                 echo $guest_data['relation'];
                 echo "</td><td>";
                 echo $guest_data['contact'];
                 echo "</td></tr>";

             }


             echo "</table>";
            if ($booking_data['booking_status']!='CANCELLED')
            { echo "<a style='float:right;' onclick=\"return confirm('Are you sure you want to cancel');\" href='cancel_booking.php?booking_id=";
             echo $rr['booking_id'];
             echo "&booking_status=CANCELLED'>Cancel Booking</a>";}

             echo "</td></tr>";


            }

       }
      echo "</table>";


?>

    </body>
</html>
