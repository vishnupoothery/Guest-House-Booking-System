<?php

include_once('dbConfig.php');


$sql = "INSERT INTO booked (purpose,	booking_status,	payment status,	no_guests,	no_rooms	,no_groups
)
VALUES ('".$_POST['purpose']."','WAITING APPROVAL','".$_POST['payment']."', '".$_SESSION['guestsno']."','".$_POST['roomsno']."',1)";



if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$sql ="INSERT INTO  guests (checkin,checkout,name,	relation,contact) VALUES ('".$_SESSION['checkin']."','".$_SESSION['checkout']."','".$POST['name']."','".$POST['rel']."','".$POST['contact']."')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
header('checkAvailability.php');
?>
