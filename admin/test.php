<?php
include '../mail/mail.php';
$message = "<html>
<div style='text-align:center;position:relative;'>
    <h3 style='color:#23aacc;'>NIT-C GUEST HOUSE BOOKING</h3>
    <h3><b>Your booking ID is 57 </b></h3>
    <table style='margin-left:auto; margin-right:auto;' cellspacing='10px'>
        <tr>
            <td rowspan='3' style=' font-size: 120%;
font-weight:  bold;
text-align: center;
color: #00c434;
border-style: dashed;
border-color: #00c434;
padding-left:10%;
padding-right:10%;'>

                ROOM ALLOTED

            </td>
            <td >Checkin </td>
            <td>: 26th December 2019 </td>
        </tr>
        <tr>
            <td>Checkout </td>
            <td>: 28th December 2019</td>
        </tr>
        <tr>
            <td>Room(s)</td>
            <td>: 222</td>
        </tr>
    </table>
</div>
</html>";
  $toMail = "jyothsna_b160901cs@nitc.ac.in";
  $subject = "Room Alloted";
  echo sendMail($toMail, $subject, $message);
?>

<html>
<div style='text-align:center;position:relative;'>
    <h3 style='color:#23aacc;'>NIT-C GUEST HOUSE BOOKING</h3>
    <h3><b>Your booking ID is " . $booking_id . " </b></h3>
    <table style='margin-left:auto; margin-right:auto;' cellspacing='20%'>
        <tr>
            <td rowspan="3" style=' font-size: 120%;
font-weight:  bold;
text-align: center;
color: #00c434;
border-style: dashed;
border-color: #00c434;
padding-left:10%;
padding-right:10%;'>

                ROOM ALLOTED

            </td>
            <td >Checkin </td>
            <td>: " .date('F jS Y', strtotime($book['checkin'])) . " </td>
        </tr>
        <tr>
            <td>Checkout </td>
            <td>: " .date('F jS Y', strtotime($book['checkout'])) . "</td>
        </tr>
        <tr>
            <td>Room(s)</td>
            <td>: " . $rooms_list . "</td>
        </tr>
    </table>
</div>
</html>