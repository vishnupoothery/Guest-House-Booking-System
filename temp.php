<?php
include 'checkLogin.php';
include 'mail/mail.php';

include('dbConfig.php');
$booked_by ="jyothsna_b160901cs@nitc.ac.in";
    $ = "<div style='margin-left:auto;margin-right:auto;'>Your booking id is $booking_id.<hr>
    <table style='border:none;'>
    <tr>
     <td>Check-in<td>
     <td>:  $checkin</td>
     </tr><tr>
     <td>Check-in<td>
     <td>:  $checkin</td>
     </tr><tr>
     <td>Check-out<td>
     <td>:  $checkout</td>
     </tr><tr>
     <td>Number of Guests<td>
     <td>:  $guests</td>
     </tr><tr>
     <td>Number of Rooms Required<td>
     <td>:  $rooms</td>
     </tr>
    </table>
    Your booking has been recieved and is being processed.<hr>
    </div>"; //user
    $toMail = $booked_by;
    $subject = "Booking Recieved";
    echo sendMail($toMail,$subject,$message);

?>

