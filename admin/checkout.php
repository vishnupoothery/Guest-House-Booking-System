<?php 
include('session.php');
include('dbConfig.php');


$booking_id=$_POST['booking_id'];
$sql="UPDATE booked SET booking_status='CHECKED OUT' WHERE booking_id=".$booking_id;
$res=mysqli_query($db,$sql);
if($res)
{
    $sql="UPDATE guests SET actual_checkout=cast(concat('".$_POST['date']."', ' ','".$_POST['time']."') as datetime) WHERE booking_id=".$booking_id;
    $res=mysqli_query($db,$sql);
    if($res)
    {
      header("Location:upcomingbookings_admin.php");
    }
    else
    {
        echo "failed to checkout";
    }
}
else
   echo "failed";
?>