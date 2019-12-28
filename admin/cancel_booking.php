<?php
    include 'dbConfig.php';
    include '../mail/mail.php';

    $booking_id = $_GET['booking_id'];
    $sql="UPDATE booked SET booking_status='".$_GET['booking_status']."' WHERE booking_id='".$_GET['booking_id']."'";
    $sql2 = "SELECT booked_by FROM booked WHERE booking_id = $booking_id";
    $result = $db->query($sql2);
    $booked_by = $result->fetch_assoc();
    $email = $booked_by['booked_by'];

    echo $sql;
    if(mysqli_query($db,$sql))
    {
        $message = "Your Request for Guest House Booking has been REJECTED";
        $toMail = $email;
        $subject = 'Booking Rejected';
        echo sendMail($toMail,$subject,$message);
        $sql="UPDATE guests SET room_id=-1 WHERE booking_id='".$_GET['booking_id']."'";

        if(mysqli_query($db,$sql))
            {
                if($_GET['booking_status']=='CANCELLED')
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
