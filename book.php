<?php
include 'checkLogin.php';
include 'mail/mail.php';

include('dbConfig.php');
$booked_by = $_SESSION['email'];
$guests=$_GET['guestsno'];
$rooms=$_POST['roomsno'];
$sql = "INSERT INTO booked (booked_by,purpose,booking_status,payment_status,no_guests,no_rooms,no_groups) VALUES ('$booked_by','".$_POST['purpose']."  ".$_POST['purpose-desc']."','WAITING APPROVAL','".$_POST['payment']."', '".$_GET['guestsno']."','".$_POST['roomsno']."','1')";

$name = $_SESSION['userData']['f_name'];

if ($db->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $db->error;
}
$booking_id=$db->insert_id;
for($i=0;$i<$_GET['guestsno'];++$i)
{
    $sql ="INSERT INTO  guests (booking_id,expected_checkin,expected_checkout,name,relation,contact) VALUES ('".$booking_id."','".$_GET['checkin']."','".$_GET['checkout']."','".$_POST['name'][$i]."','".$_POST['rel'][$i]."','".$_POST['contact'][$i]."')";

    if ($db->query($sql) === TRUE) 
    {
        echo "New record created successfully";
   } 
   else {
        echo "Error: " . $sql . "<br>" . $db->error;
    }
}
$today=date('F jS Y',time());
$message = "<div style='margin-left:auto;margin-right:auto;'>Your booking id is $booking_id.<hr>
<table style='border:none;'>
<tr>
 
 <td>Date of Booking<td>
 <td>:  $today</td>
 </tr><tr>
 <td>Number of Guests<td>
 <td>:  $guests</td>
 </tr><tr>
 <td>Number of Rooms Required<td>
 <td>:  $rooms</td>
 </tr>
</table>
Your booking has been recieved and is being processed.<hr>
</div>";
    $toMail = $booked_by;
    $subject = "Booking Recieved";
    echo sendMail($toMail,$subject,$message);


    $message = "$name has created a request for Guest House rooms"; //admin
    $toMail = $booked_by;
    $subject = "New Booking";
    echo sendMail($toMail,$subject,$message);

    $message = "$name has created a request for Guest House.  <a href='https://guesthouse.nitc.ac.in/registrar'>Login</a> to approve"; //registrar
    $toMail = "jyothsnashaji99@gmail.com";
    $subject = "New Guest House Booking";
    echo sendMail($toMail,$subject,$message); 

    header('Location: upcomingbookings_user.php');


?>
