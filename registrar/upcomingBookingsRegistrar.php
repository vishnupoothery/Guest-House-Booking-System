<?php
include('session.php');
include('header.php');
include('dbConfig.php');


?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/mystyles.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/jquery.min.js"></script>
  <script src="../js/myjs.js"></script>
  <title>NITC GH</title>
</head>

<body>
  <?php echo display_header();
  echo display_admin_navbar(); ?>

  <script>
    activateTab('upcoming');
  </script>

  <div class='container'>
    <div class='row'>
    <input class="form-control" id="myInput" type="text" placeholder="Search..">

    </div>
  </div>
  <?php
  $sql = "SELECT DISTINCT `booking_id` FROM guests WHERE checkin>DATE_FORMAT(now(),'%Y%c%d') AND room_id!=-1";

  $result = mysqli_query($db, $sql);
  echo "<table class='table table-hover'> <tbody id='myTable'> <tr><th>BOOKING DATE </th><th>BOOKED BY</th><th>CHECKIN</th><th>CHECKOUT</th><th>PURPOSE</th><th>  BOOKING STATUS</th><th></th></tr>";
  if ($result) {
    while ($rr = mysqli_fetch_array($result)) {
      $get_booking_data = "SELECT booked_by,DATE_FORMAT(booking_date,'%d-%m-%y') as booking_date,booked_by,purpose,booking_status,no_guests,no_rooms FROM booked WHERE booking_id=" . $rr['booking_id'] . "";
      $booking_data_res = mysqli_query($db, $get_booking_data);
      $booking_data = mysqli_fetch_assoc($booking_data_res);
      $get_guest_data = "SELECT DATE_FORMAT(checkin,'%d-%m-%y') as checkin,DATE_FORMAT(checkout,'%d-%m-%y') as checkout FROM guests WHERE booking_id=" . $rr['booking_id'] . "";
      $guest_data_res = mysqli_query($db, $get_guest_data);
      $guest_data = mysqli_fetch_assoc($guest_data_res);
      echo "<tr class='collapserow' onclick='toggle_collapse(";
      echo $rr['booking_id'];
      echo ")'><td>";
      echo $booking_data['booking_date'];
      echo "</td><td>";
      echo $booking_data['booked_by'];
      echo "</td><td>";
      echo $guest_data['checkin'];
      echo "</td><td>";
      echo $guest_data['checkout'];
      echo "</td><td>";
      echo $booking_data['purpose'];
      echo "</td><td>";
      echo $booking_data['booking_status'];
      echo "</td></tr><tr id='collapse";
      echo $rr['booking_id'];
      echo "' class='collapse out '><td align='middle'  colspan=4><div class='guest-details'>";

      $checkin = $guest_data['checkin'];
      $checkout = $guest_data['checkout'];
      $get_guest_data = "SELECT * FROM guests WHERE booking_id=" . $rr['booking_id'] . "";
      $guest_data_res = mysqli_query($db, $get_guest_data);

      echo "<table class='table'>";
      echo "<tr><td>Guests: ";
      echo $booking_data['no_guests'];
      echo "</td><td> Rooms required: ";
      echo $booking_data['no_rooms'];
      echo "</td></tr>";

      while ($guest_data = mysqli_fetch_array($guest_data_res)) {
        echo "<tr><td>";
        echo $guest_data['name'];
        echo "</td><td>";
        echo $guest_data['relation'];
        echo "</td><td>";
        echo $guest_data['contact'];
        echo "</td></tr>";
      }


      echo "</table></div>";

      if ($booking_data['booking_status'] == 'WAITING APPROVAL') {
        echo "<button style='float:left;' type='button' class='btn btn-prim'><a style='color:white;text-decoration:none;' onclick=\"return confirm('Are you sure you want to approve');\" href='approveBooking.php?booking_id=";
        echo $rr['booking_id'];
        echo "'>Approve </a></button>";
      }
      if ($booking_data['booking_status'] != 'CANCELLED') {
        echo "<button style='float:right;' type='button' class='btn btn-prim'><a style='color:white;text-decoration:none;' onclick=\"return confirm('Are you sure you want to cancel');\" href='cancel_booking.php?booking_id=";
        echo $rr['booking_id'];
        echo "&booking_status=REJECTED'>Reject</a></button>";
      }

      if (strpos($booking_data['booking_status'], 'ALLOTED') !== false) {
        $get_room_data = "SELECT room_num FROM rooms WHERE room_id IN (SELECT room_id FROM guests WHERE booking_id=" . $rr['booking_id'] . ")";
        $room_data_res = mysqli_query($db, $get_room_data);
        echo "The alloted room(s) are: ";
        while ($room_data = mysqli_fetch_array($room_data_res)) {
          echo $room_data['room_num'] . " ";
        }
      }

      echo "</td></tr>";
    }
  }
  echo "</table>";

  /* SELECT room_id, room_num FROM rooms WHERE room_id NOT IN (SELECT room_id ,  DATE_FORMAT(checkin,'%d-%m-%y') as checkin,   DATE_FORMAT(checkout,'%d-%m-%y') as checkout FROM guests WHERE room_id!=0 AND DATE_FORMAT(checkin,'%d-%m-%y')<11-10-19 AND DATE_FORMAT(checkout,'%d-%m-%y') > 07-10-19) */
  ?>
  </div>
  
  <script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
</body>

</html>