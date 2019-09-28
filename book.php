<?php

include('dbConfig.php');


$sql = "INSERT INTO booked (purpose,booking_status,	payment_status,	no_guests,	no_rooms	,no_groups
)
VALUES ('".$_POST['purpose']."','WAITING APPROVAL','".$_POST['payment']."', '".$_GET['guestsno']."','".$_POST['roomsno']."','1')";



if ($db->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $db->error;
}

$sql ="INSERT INTO  guests (booking_id,checkin,checkout,name,	relation,contact) VALUES ('".$db->insert_id."','".$_GET['checkin']."','".$_GET['checkout']."','".$_POST['name']."','".$_POST['rel']."','".$_POST['contact']."')";

if ($db->query($sql) === TRUE) {
   header('Location: upcomingbookings_user.php');
}

?>
