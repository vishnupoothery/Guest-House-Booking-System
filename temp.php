<?php
    include 'mail/mail.php';

   
    $message = "Your Request for Gust House Booking has been REJECTED";
    $toMail = 'vishnupoothery@gmail.com';
    $subject = 'Booking Rejected';
    echo sendMail($toMail,$subject,$message);
?>
