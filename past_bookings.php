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
  $sql = "SELECT DISTINCT A.booking_id from guests A, booked B WHERE B.booked_by = '" . $user_id . "' AND (A.room_id=-1 OR (A.booking_id = B.booking_id AND A.checkout<DATE_FORMAT(now(),'%Y%c%d')) )";
  //$sql="SELECT DISTINCT `booking_id` FROM guests WHERE checkout<DATE_FORMAT(now(),'%Y%c%d') OR room_id=-1";// and booked_by=user_id;
  $result = mysqli_query($db, $sql);
  echo "<table class='table table-hover'>";
  if ($result) {
    while ($rr = mysqli_fetch_array($result)) {
      $get_booking_data = "SELECT purpose,payment_status as payment,no_rooms as roomsno,booking_date,booking_status FROM booked WHERE booking_id=" . $rr['booking_id'] . "";
      $booking_data_res = mysqli_query($db, $get_booking_data);
      $booking_data = mysqli_fetch_assoc($booking_data_res);
      $get_guest_data = "SELECT checkin,checkout FROM guests WHERE booking_id=" . $rr['booking_id'] . "";
      $guest_data_res = mysqli_query($db, $get_guest_data);
      $guest_data = mysqli_fetch_assoc($guest_data_res);
      echo "<tr class='collapserow' onclick='toggle_collapse(";
      echo $rr['booking_id'];
      echo ")'><td class='status-container'>";
      if ($booking_data['booking_status'] == 'WAITING APPROVAL')
        echo "<div class='status awaiting'>";
      else if ($booking_data['booking_status'] == 'REJECTED' || $booking_data['booking_status'] == 'CANCELLED')
        echo "<div class='status cancelled'>";
      else
        echo "<div class='status approved'>";
      echo $booking_data['booking_status'];
      echo "<div>";
      echo "</td><td class=' booking-details'><b>Checkin: </b> ";
      echo date('F jS Y', strtotime($guest_data['checkin']));
      echo "<br><br><b>Checkout: </b>";
      echo date('F jS Y', strtotime($guest_data['checkout']));
      echo "<br><br><span style='opacity:0.5;'>Booking Date: ";
      echo date('F jS Y', strtotime($booking_data['booking_date']));
      echo "</span><br></td></tr><tr id='collapse";
      echo $rr['booking_id'];
      echo "' class='collapse out'><td align='middle' colspan=2><div  class='guest-details' >";

      $get_guest_data = "SELECT * FROM guests WHERE booking_id=" . $rr['booking_id'] . "";
      $guest_data_res = mysqli_query($db, $get_guest_data);

      echo "<table ><tr><td>Rooms Requested:    ";
      echo $booking_data['roomsno'];
      echo "</td><td>Purpose:    ";
      echo $booking_data['purpose'];
      echo "</td><td>Payment Mode:   ";
      echo $booking_data['payment'];
      echo "</td></tr><tr><td align='center' colspan=3>GUESTS</td>";

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

      echo "</td></tr>";
    }
  }
  echo "</table>";


  ?>

</body>

</html>