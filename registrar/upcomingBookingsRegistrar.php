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
  <script src="../js/bootstrap.bundle.min.js"></script>

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
<br>
<div class='container'>
    <div class='row'>
      <div class='col'>
        <select class="form-control" id="searchby">
          <option selected disabled>Search By</option>
          <option value='booking_id'>Booking ID</option>
          <option value='booking_status'>Booking Status</option>
          <option value='booking_by'>Booking By</option>
        </select>
      </div>
      <div class='col'>
        <input class="form-control" id="searchfor" type="text" placeholder="Enter" onkeyup='displayTable();'>
      </div>
    </div>
  </div>
  <?php
  $sql = "SELECT DISTINCT `booking_id` FROM guests WHERE expected_checkin>now() AND (room_id!=-1 OR room_id is NULL) AND actual_checkout is NULL ORDER BY booking_id DESC";

  $result = mysqli_query($db, $sql);
  echo "<div class='row justify-content-center'><div class='booking'><table id='myTable' class='table table-hover'>";
  if ($result) {
    while ($rr = mysqli_fetch_array($result)) {
      $get_booking_data = "SELECT booked_by,purpose,payment_status as payment,no_rooms as roomsno,booking_date,booking_status FROM booked WHERE booking_id=" . $rr['booking_id'] . "";
      $booking_data_res = mysqli_query($db, $get_booking_data);
      $booking_data = mysqli_fetch_assoc($booking_data_res);
      $get_guest_data = "SELECT expected_checkin as checkin,expected_checkout as checkout FROM guests WHERE booking_id=" . $rr['booking_id'] . "";
      $guest_data_res = mysqli_query($db, $get_guest_data);
      $guest_data = mysqli_fetch_assoc($guest_data_res);
      $checkin = $guest_data['checkin'];
      $checkout = $guest_data['checkout'];
      echo "<tr><td><div class='row justify-content-center collapserow' onclick='toggle_collapse(";
      echo $rr['booking_id'];
      echo ")'>";
      if ($booking_data['booking_status'] == 'WAITING APPROVAL')
        echo "<div class='col status awaiting'>";
      else if ($booking_data['booking_status'] == 'OFFICIALLY APPROVED')
        echo "<div class='col status officially'>";
      else
        echo "<div class='col status approved'>";
      echo "<span class='booking_id'>";
      echo $rr['booking_id'];
      echo "</span><br><span class='booking_status'>";
      echo $booking_data['booking_status'];
      echo "</span>";
      echo "</div>";
      echo "<div class='col booking-details'><b>Booked By: </b><span class='booked_by'>";
      echo $booking_data['booked_by'];
      echo "</span><br><br><b>Checkin: </b> ";
      echo date('F jS Y', strtotime($guest_data['checkin']));
      echo "<br><br><b>Checkout: </b>";
      echo date('F jS Y', strtotime($guest_data['checkout']));
      echo "<br><br><span style='opacity:0.5;'>Booking Date: ";
      echo date('F jS Y', strtotime($booking_data['booking_date']));
      echo "</span><br></div><br>";
      echo "</div><div id='collapse";
      echo $rr['booking_id'];
      echo "' class='collapse out'><div class='row justify-content-center'><div class='col guest-details' align='middle'>";

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


      echo "</table></div></div>";

   
      if (strpos($booking_data['booking_status'], 'ALLOTED') !== false) {
        $get_room_data = "SELECT room_num FROM rooms WHERE room_id IN (SELECT room_id FROM guests WHERE booking_id=" . $rr['booking_id'] . ")";
        $room_data_res = mysqli_query($db, $get_room_data);
        echo "<div class='row justify-content-center'> <div class='col-6'>The alloted room(s) are: ";
        while ($room_data = mysqli_fetch_array($room_data_res)) {
          echo $room_data['room_num'] . " ";
        }
        echo "</div></div>";
      }
      echo "<div class='row justify-content-center'><div class='col-3'>";
      if ($booking_data['booking_status'] == 'WAITING APPROVAL') {
        echo "<button  type='button' class='btn btn-prim'><a style='color:white;text-decoration:none;' onclick=\"return confirm('Are you sure you want to approve');\" href='approveBooking.php?booking_id=";
        echo $rr['booking_id'];
        echo "'>Approve </a></button>";
      }
      echo "</div><div class='col-3'>";
      if ($booking_data['booking_status'] != 'CANCELLED') {
        echo "<button style='float:right;' type='button' class='btn btn-prim' onclick='openCancelModal(";
        echo $rr['booking_id'];
        echo ");'>Reject</button>";
      }

      echo "</div></div></div><br></td></tr>";
    }
  }
  echo "</table></div></div>";

  /* SELECT room_id, room_num FROM rooms WHERE room_id NOT IN (SELECT room_id ,  DATE_FORMAT(checkin,'%d-%m-%y') as checkin,   DATE_FORMAT(checkout,'%d-%m-%y') as checkout FROM guests WHERE room_id!=0 AND DATE_FORMAT(checkin,'%d-%m-%y')<11-10-19 AND DATE_FORMAT(checkout,'%d-%m-%y') > 07-10-19) */
  ?>
  </div>
<!-------------------CANCEL MODAL-------------------->
<div id="cancelModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Are you sure you want to cancel?</h4>
        <span class="close" onclick="document.getElementById('cancelModal').style.display='none';">&times;</span>
      </div>
      <form method="post" id="cancel">
        <div class="modal-body">
          <div class='form-group'>
              <input type="text" name='remark' id='remark' placeholder='Remark' required>
          </div>

        <div class="modal-footer">
          <input class='btn btn-prim' type="submit" value='Cancel Booking'>
        </div>
      </form>
    </div>
  </div>



</body>

</html>
