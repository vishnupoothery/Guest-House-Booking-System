<?php
$rooms=count($_POST['allotedrooms']);
include 'dbConfig.php';
if ($rooms>1)
$sql="UPDATE booked SET booking_status = '(".$rooms.") ROOMS ALLOTED' WHERE booking_id='".$_GET['booking_id']."'";
else
    $sql="UPDATE booked SET booking_status = '(".$rooms.") ROOM ALLOTED' WHERE booking_id='".$_GET['booking_id']."'";

if($db->query($sql)===TRUE)
{
    $sql="SELECT guest_id FROM guests WHERE booking_id=".$_GET['booking_id']."";

    $res=mysqli_query($db,$sql);
    $i=0;
    while($guests=mysqli_fetch_array($res))
    {
        $roomid=$_POST['allotedrooms'][$i%$rooms];
         $sql="UPDATE guests SET room_id=".$roomid." WHERE guest_id='".$guests['guest_id']."'";
        if(!mysqli_query($db,$sql))
        {

           echo $db->error;
        }
        ++$i;
    }

  echo $db->error;
header("Location: upcomingbookings_admin.php");

}

?>
