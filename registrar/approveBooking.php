<?php
include 'session.php';
include 'dbConfig.php';
include '../mail/mail.php';

$booking_id=$_GET['booking_id'];

$sql="UPDATE booked SET booking_status='OFFICIALLY APPROVED' WHERE booking_id='".$booking_id."'" ;
$res=mysqli_query($db,$sql);
if($res)
{
    
    $message = "Booking number $booking_id has been approved by registrar. Login to allot rooms.";
    $toMail = "jyothsnashaji99@gmail.com";
    $subject = "Booking  $booking_id  Approved";
    echo sendMail($toMail,$subject,$message);
    header('Location:upcomingBookingsRegistrar.php');
 
}
else
{
    echo $db->error;
}



?>