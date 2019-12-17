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
  $sql = "SELECT DISTINCT `booking_id` FROM guests WHERE checkin>DATE_FORMAT(now(),'%Y%c%d') AND room_id!=-1";

  $result = mysqli_query($db, $sql);
  echo "<table id='myTable' class='table table-hover'>";
  if ($result) {
    while ($rr = mysqli_fetch_array($result)) {
      $get_booking_data = "SELECT booked_by,purpose,payment_status as payment,no_rooms as roomsno,booking_date,booking_status FROM booked WHERE booking_id=" . $rr['booking_id'] . "";
      $booking_data_res = mysqli_query($db, $get_booking_data);
      $booking_data = mysqli_fetch_assoc($booking_data_res);
      $get_guest_data = "SELECT checkin,checkout FROM guests WHERE booking_id=" . $rr['booking_id'] . "";
      $guest_data_res = mysqli_query($db, $get_guest_data);
      $guest_data = mysqli_fetch_assoc($guest_data_res);
      $checkin = $guest_data['checkin'];
      $checkout = $guest_data['checkout'];
      echo "<tr><td class='status-container'><div class='row justify-content-center collapserow' onclick='toggle_collapse(";
      echo $rr['booking_id'];
      echo ")'>";
      if ($booking_data['booking_status'] == 'WAITING APPROVAL')
        echo "<div class='col-2 status awaiting'>";
      else
        echo "<div class='col-2 status approved'>";
      echo "<span class='booking_id'>";
      echo $rr['booking_id'];
      echo "</span><br><span class='booking_status'>";
      echo $booking_data['booking_status'];
      echo "</span>";
      echo "</div>";
      echo "<div class='col-5 booking-details'><b>Booked By: </b><span class='booked_by'>";
      echo $booking_data['booked_by'];
      echo "</span><br><br><b>Checkin: </b> ";
      echo date('F jS Y', strtotime($guest_data['checkin']));
      echo "<br><br><b>Checkout: </b>";
      echo date('F jS Y', strtotime($guest_data['checkout']));
      echo "<br><br><span style='opacity:0.5;'>Booking Date: ";
      echo date('F jS Y', strtotime($booking_data['booking_date']));
      echo "</span><br></div><br><div class='col-1'>
      <a  href='#' data-toggle='dropdown' >
       <i class='material-icons'>more_vert</i>
      </a>
    
      <div class='dropdown-menu' >";
      if ($booking_data['booking_status'] == 'OFFICIALLY APPROVED') {
        echo "<a class='dropdown-item'  onclick=\"document.getElementById('allotrooms";
        echo $rr['booking_id'];
        echo "').style.display='block';\">Allot Rooms </a>";
      }

      if (strpos($booking_data['booking_status'], 'ALLOTED') !== false) {
        echo "<a class='dropdown-item  onclick=\"return prompt('Check-in Time');\" href='checkin.php?booking_id=";
        echo $rr['booking_id'];
        echo "'>Check-in Guests</a>";
      }


      if (strpos($booking_data['booking_status'], 'CHECK') !== true) {
        echo "<a class='dropdown-item' onclick=\"return confirm('Are you sure you want to cancel');\" href='cancel_booking.php?booking_id=";
        echo $rr['booking_id'];
        echo "&booking_status=REJECTED'>Cancel Booking</a>";
      }

      echo "</div>
    </div></div><div id='collapse";
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

      if ($booking_data['booking_status'] == 'OFFICIALLY APPROVED') {

        $get_room_data =    "SELECT room_id, room_num FROM rooms WHERE room_id NOT IN (SELECT room_id FROM guests WHERE room_id!=0 AND DATE_FORMAT(checkin,'%d-%m-%y')< '" . $checkout . "' AND DATE_FORMAT(checkout,'%d-%m-%y') >'" . $checkin . "' )";
        echo "<form action='allotroom.php?booking_id=";
        echo $rr['booking_id'];
        echo "' style='display:none;' id='allotrooms";
        echo $rr['booking_id'];
        echo "' method='post'><div class='col-sm-5'><label>Hold down Ctrl key to select multiple rooms</label><select multiple name='allotedrooms[]' class='form-control' >";
        $room_data_res = mysqli_query($db, $get_room_data);
        while ($room_data = mysqli_fetch_array($room_data_res)) {
          echo "<option value='";
          echo $room_data['room_id'];
          echo "'>";
          echo $room_data['room_num'];
          echo "</option>";
        }


        echo "</select></div><div class='col-sm-1'><button class='btn btn-prim' type='submit'>Allot</button></div></form></div>";
      }
      if (strpos($booking_data['booking_status'], 'ALLOTED') !== false) {
        $get_room_data = "SELECT room_num FROM rooms WHERE room_id IN (SELECT room_id FROM guests WHERE booking_id=" . $rr['booking_id'] . ")";
        $room_data_res = mysqli_query($db, $get_room_data);
        echo "The alloted room(s) are: ";
        while ($room_data = mysqli_fetch_array($room_data_res)) {
          echo $room_data['room_num'] . " ";
        }
      }

      echo "<br></div></td></tr>";
    }
  }
  echo "</table>";

  /* SELECT room_id, room_num FROM rooms WHERE room_id NOT IN (SELECT room_id ,  DATE_FORMAT(checkin,'%d-%m-%y') as checkin,   DATE_FORMAT(checkout,'%d-%m-%y') as checkout FROM guests WHERE room_id!=0 AND DATE_FORMAT(checkin,'%d-%m-%y')<11-10-19 AND DATE_FORMAT(checkout,'%d-%m-%y') > 07-10-19) */
  ?>
  </div>



</body>

</html>

