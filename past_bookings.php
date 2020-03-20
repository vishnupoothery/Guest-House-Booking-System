<?php
include 'checkLogin.php';
include 'dbConfig.php' ;
include 'header.php' ;
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/mystyles.css">

  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.min.js"></script>
  <script src="js/myjs.js"></script>

  <title>NITC GH</title>
</head>

<body >
  <?php echo display_header();
  echo display_user_navbar(); ?>

  <script>
    activateTab('past');
  </script>
  
  <?php

  $user_id = $_SESSION['email'];
  $sql =  "SELECT DISTINCT B.booking_id,B.booking_date from guests A, booked B WHERE
        B.booked_by = '" . $user_id . "' AND A.booking_id = B.booking_id
        AND (A.room_id=-1  OR A.actual_checkout<now() )
ORDER BY B.booking_date DESC";
 # echo $sql;
  //$sql="SELECT DISTINCT `booking_id` FROM guests WHERE checkout<DATE_FORMAT(now(),'%Y%c%d') OR room_id=-1";// and booked_by=user_id;
  $result = mysqli_query($db, $sql);
  echo "<br><table class='table table-hover'>";
  if ($result) {

      while ($rr = mysqli_fetch_array($result)) {
        $get_booking_data = "SELECT purpose,payment_status as payment,no_rooms as roomsno,booking_date,booking_status FROM booked WHERE booking_id=" . $rr['booking_id'] . "";
        $booking_data_res = mysqli_query($db, $get_booking_data);
        $booking_data = mysqli_fetch_assoc($booking_data_res);
        $get_guest_data = "SELECT actual_checkin,actual_checkout,expected_checkin,expected_checkout FROM guests WHERE booking_id=" . $rr['booking_id'] . "";
        $guest_data_res = mysqli_query($db, $get_guest_data);
        $guest_data = mysqli_fetch_assoc($guest_data_res);
        if($guest_data['actual_checkin'])
        {
          $checkin = $guest_data['actual_checkin'];
          $checkout = $guest_data['actual_checkout'];
        }
      else
      {
        $checkin = $guest_data['expected_checkin'];
        $checkout = $guest_data['expected_checkout'];

      }
        echo "<tr><td class='status-container'><div class='row justify-content-center collapserow' onclick='toggle_collapse(";
        echo $rr['booking_id'];
        echo ")'>";
        if ($booking_data['booking_status'] == 'WAITING APPROVAL')
          echo "<div class='col-2 status awaiting'>";
        else if ($booking_data['booking_status'] == 'REJECTED' || $booking_data['booking_status'] == 'CANCELLED')
          echo "<div class='col-2 status cancelled'>";
        else
          echo "<div class='col-2 status approved'>";
        echo $booking_data['booking_status'];
        echo "</div>";
        echo "<div class='col-3 booking-details'>";
        echo"<b>Booking ID: </b> ";
        echo $rr['booking_id'];
        echo"<br><br><b>Checkin: </b> ";
        echo date('F jS Y', strtotime($checkin));
        echo "<br><br><b>Checkout: </b>";
        echo date('F jS Y', strtotime($checkout));
        echo "<br><br><span style='opacity:0.5;'>Booking Date: ";
        echo date('F jS Y', strtotime($booking_data['booking_date']));
        echo "</span><br></div></div><br><div id='collapse";
        echo $rr['booking_id'];
        echo "' class='row  justify-content-center collapse out'><div class='col guest-details' align='middle'>";
  
        $get_guest_data = "SELECT * FROM guests WHERE booking_id=" . $rr['booking_id'] . "";
        $guest_data_res = mysqli_query($db, $get_guest_data);
  
        echo "<table ><tr><td><b>Rooms Requested:</b>    ";
        echo $booking_data['roomsno'];
        echo "</td><td><b>Purpose:</b>    ";
        echo $booking_data['purpose'];
        echo "</td><td><b>Payment Mode:</b>   ";
        echo $booking_data['payment'];
        echo "</td></tr><tr><td align='center' colspan=3><b>GUESTS</b></td>";
  
        while ($guest_data = mysqli_fetch_array($guest_data_res)) {
          echo "<tr><td>";
          echo $guest_data['name'];
          echo "</td><td>";
          echo $guest_data['relation'];
          echo "</td><td>";
          echo $guest_data['contact'];
          echo "</td></tr>";
        }
  
  
        echo "</table>";
  
     
        echo "</div></td></tr>";
      }
    }
    echo "</table>";

  ?>

</body>

</html>