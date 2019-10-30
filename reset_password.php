<?php
include 'mail/mail.php';
include 'dbConfig.php';

if(isset($_GET['code'])){
    $hash = $_GET['code'];
    $email = $_GET['email'];

    $sql = "SELECT * FROM forgot_password WHERE hash = '$hash' AND used = 0";
    $result = $db->query($sql);

    if($result->num_rows < 1){
        $error = "Invalid/Expired token";
    }
    
    $user = $result->fetch_assoc();

    $sql2 = "UPDATE forgot_password SET used = 1 WHERE hash = '$hash'";
    $result = $db->query($sql2);
}
?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/mystyles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <title>NITC GH</title>
</head>

<body>
    <?php


   { include("dbConfig.php");

    if(isset($_POST['submit_register'])){
        $email = $_POST['email'];
        $passwd = password_hash($_POST['passwd'], PASSWORD_BCRYPT);
        $dept = $_POST['dept'];
        $student = $_POST['student'];
        $fullname = $_POST['fullname'];
        $hash = hash('sha256', $email.$fullname.date("Y-m-d h:i:sa"));
        $rollno = 'b160688cs';
        
        //var_dump($_POST);
        $sql = "INSERT INTO users (email,passwd,fullname,student,rollno,dept,hash) VALUES ('$email','$passwd','$fullname',$student,'$rollno','$dept','$hash')";
        //echo '<br>'.$sql;

        $base_url = "http://localhost/Guest-House-Booking-System";
        $message = "Welcome to NITC Guest House Management System
                    <br><br>
                    To complete registration process please follow this link : <br>
                    $base_url/user_verify.php?email=$email&code=$hash
        ";

        $toMail = $email;
        $subject = "Welcome to NITC Guest House";
        $mail_res = sendMail($toMail,$subject,$message);

        if (mysqli_query($db,$sql) == TRUE){
            $message = "User Registered. Check Verification Mail to Complete Registration";
        }
        else{
            $message = "User Registeration Failes. Try again after sometime";
        }

    }
}
?>
    <div id="login_modal_" class="_modal">

        <form class="modal-content animate" method="post" id="email_form">

            <div class="container">
                <?php
                    if(isset($error)){
                        echo $error;
                    }
                    else{
                        echo '<label for="passwd"><b>Enter new Password</b></label>
                        <input type="password" placeholder="Enter new Password" name="passwd" required>
                        <input type="submit" class="btn btn-primary" value="CHANGE PASSWORD" name="submit_register">';
                    }
                ?>
                
            </div>

            <div class="container">

                <span class="psw"> <a href="#"> Forgot password?</a></span>
            </div>
        </form>
    </div>
</body>

</html>