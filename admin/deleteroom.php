<?php

include('dbConfig.php');
$sql="DELETE from rooms WHERE room_id='".$_GET['room_id']."'";
if(mysqli_query($db,$sql))
{
header("Location: rooms.php");
}
?>
