<?php
include 'dbConfig.php';

$sql="UPDATE rooms SET ".$_POST['change-criteria']."='".$_POST['changed-value']."' WHERE ".$_POST['selection-criteria']."='".$_POST['selected-value']."'";

if(mysqli_query($db,$sql))
{
header("Location: rooms.php");
}
else
{
    echo $db->error;
}

?>
