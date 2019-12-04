<?php
$rooms = count($_POST['allotedrooms']);
include 'dbConfig.php';
include '../mail/mail.php';
$booking_id = $_GET['booking_id'];
if ($rooms > 1)
  $sql = "UPDATE booked SET booking_status = '(" . $rooms . ") ROOMS ALLOTED' WHERE booking_id='" . $_GET['booking_id'] . "'";
else
  $sql = "UPDATE booked SET booking_status = '(" . $rooms . ") ROOM ALLOTED' WHERE booking_id='" . $_GET['booking_id'] . "'";

$sql2 = "SELECT booked_by FROM booked WHERE booking_id = '" . $_GET['booking_id'] . "'";
$result = $db->query($sql2);
$booked_by = $result->fetch_assoc();
$email = $booked_by['booked_by'];

if ($db->query($sql) === TRUE) {
  $sql = "SELECT guest_id FROM guests WHERE booking_id=" . $_GET['booking_id'] . "";

  $res = mysqli_query($db, $sql);
  $i = 0;

  while ($guests = mysqli_fetch_array($res)) {
    $roomid = $_POST['allotedrooms'][$i % $rooms];
    $sql = "UPDATE guests SET room_id=" . $roomid . " WHERE guest_id='" . $guests['guest_id'] . "'";
    if (!mysqli_query($db, $sql)) {

      echo $db->error;
    }
    ++$i;
  }
  $sql = "SELECT checkin,checkout FROM guests WHERE booking_id=" . $booking_id . " ";
  $res = mysqli_query($db, $sql);
  $book = mysqli_fetch_assoc($res);
  $rooms_list = '';
  for ($i = 0; $i < $rooms; ++$i) {
    $sql = "SELECT room_num FROM rooms where room_id=" . $_POST['allotedrooms'][$i] . "";
    $res = mysqli_query($db, $sql);
    $rr = mysqli_fetch_array($res);
    $rooms_list = $rooms_list + " " + $rr['room_num'];
  }
  $message = "<html>
<div style='width:50%;text-align:center;position:relative;margin-left:auto;margin-right:auto'>


<h3 style='color:#23aacc;'>NIT-C GUEST HOUSE BOOKING</h3>


<h3><b>Your booking ID is " . $booking_id . " </b></h3>
<table border=0>
  <tr>
  <td style='height: 100px;
   width: 25%;
'>
  <div style='font-size: 25px;
font-weight:  bold;
text-align: center;
margin-left: auto;
margin-right: auto;
color: #00c434;
border-style: dashed;
border-color: #00c434;
'>
    ROOM ALLOTED
      </div>
    </td>
    <td> <div style='margin-left:20px;'>
    Checkin :" . $book['checkin'] . " <br>
    Checkout :" . $book['checkout'] . " <br>
      Rooms: " . $rooms_list . "<br>
    </div>
    </td>
  </tr>
  
</table>

</div>

</html>";
  $toMail = $email;
  $subject = "Room Alloted";
  echo sendMail($toMail, $subject, $message);
  header("Location: upcomingbookings_admin.php");
}
