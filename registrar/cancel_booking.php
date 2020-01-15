<?php
    include 'session.php';
    include 'dbConfig.php';
    include '../mail/mail.php';

    $booking_id = $_GET['booking_id'];
    $rejectedBy=$_SESSION['admin'];
    $remark=$_POST['remark'];

    $sql="UPDATE booked SET booking_status=REJECTED WHERE booking_id='".$_GET['booking_id']."'";
    $sql2 = "SELECT booked_by FROM booked WHERE booking_id = $booking_id";
    $sql3="INSERT into rejectedBookings VALUES(".$booking_id.",'".$rejectedBy."','".$remark."')";

    $result = $db->query($sql2);
    $booked_by = $result->fetch_assoc();
    $email = $booked_by['booked_by'];

    echo $sql;
    if(mysqli_query($db,$sql) && mysqli_query($db,$sql3))
    {
        $message = "Your Request for Guest House Booking has been REJECTED Remark :".$remark;
        $toMail = $email;
        $subject = 'Booking Rejected';
        echo sendMail($toMail,$subject,$message);
        $sql="UPDATE guests SET room_id=-1 WHERE booking_id='".$_GET['booking_id']."'";

        if(mysqli_query($db,$sql))
            {
                header("Location: upcomingBookingsRegistrar.php"); }
        else
            echo $db->error;
    }
    else
    {
        echo $db->error;
    }

?>
