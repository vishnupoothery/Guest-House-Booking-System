<?php
include 'checkLogin.php';
include 'mail/mail.php';

include('dbConfig.php');
$booked_by = $_SESSION['email'];
$sql = "INSERT INTO booked (booked_by,purpose,booking_status,payment_status,no_guests,no_rooms,no_groups) VALUES ('$booked_by','".$_POST['purpose']." - ".$_POST['purpose-desc']."','WAITING APPROVAL','".$_POST['payment']."', '".$_GET['guestsno']."','".$_POST['roomsno']."','1')";

$name = $_SESSION['name'];

if ($db->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $db->error;
}
$booking_id=$db->insert_id;
for($i=0;$i<$_GET['guestsno'];++$i)
{$sql ="INSERT INTO  guests (booking_id,checkin,checkout,name,	relation,contact) VALUES ('".$booking_id."','".$_GET['checkin']."','".$_GET['checkout']."','".$_POST['name'][$i]."','".$_POST['rel'][$i]."','".$_POST['contact'][$i]."')";

if ($db->query($sql) === TRUE) {
   echo "New record created successfully";
   $message = "$name has created a request for Guest House";
   $toMail = "pootherivishnu@gmail.com";
   $subject = "New Booking";
   echo sendMail($toMail,$subject,$message);


   
   
} else {
    echo "Error: " . $sql . "<br>" . $db->error;
}
 header('Location: upcomingbookings_user.php');
}

?>
