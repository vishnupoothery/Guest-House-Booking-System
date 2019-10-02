<?php
include 'dbConfig.php';

$sql="UPDATE booked SET booking_status='CANCELLED' WHERE booking_id='".$_GET['booking_id']."'";
echo $sql;
if(mysqli_query($db,$sql))
{
    /*$sql="DELETE FROM guests WHERE booking_id='".$_GET['booking_id']."'";

    if(mysqli_query($db,$sql))*/

        header("Location: upcomingbookings_user.php");
}
else
{
    echo $db->error;
}

?>
