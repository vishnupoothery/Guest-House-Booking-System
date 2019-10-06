<?php
include 'dbConfig.php';

$sql="UPDATE booked SET booking_status='".$_GET['booking_status']."' WHERE booking_id='".$_GET['booking_id']."'";
echo $sql;
if(mysqli_query($db,$sql))
{
    $sql="UPDATE guests SET room_id=-1 WHERE booking_id='".$_GET['booking_id']."'";

    if(mysqli_query($db,$sql))
        {if($_GET['booking_status']=='CANCELLED')
        header("Location: upcomingbookings_user.php");
        else
         header("Location: upcomingbookings_admin.php"); }
    else
        echo $db->error;
}
else
{
    echo $db->error;
}

?>
