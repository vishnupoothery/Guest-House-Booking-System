<?php
// Include calendar helper functions
include 'header.php';
include 'mail/mail.php';

if( isset($_SESSION['email']) ){
    header("Location: index.php");
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

    if(isset($_POST['submit_reset'])){
        $email = $_POST['email'];

        $sql1 = "SELECT * FROM users WHERE email = '$email'";
        $result = $db->query($sql1);
        $user = $result->fetch_assoc();
        $fullname = $user['fullname'];
        $hash = hash('sha256', $email.$fullname.date("Y-m-d h:i:sa"));
        if ($result->num_rows > 0){
            $base_url = "http://localhost/Guest-House-Booking-System";
            $toMail = $email;
            $message = "$base_url/reset_password.php?code=$hash";
            $subject = "Password Reset Link";
            //$mail_res = sendMail($toMail,$subject,$message);
            echo sendMail($toMail,$subject,$message);
        }
    }
}
?>
    <div id="login_modal_" class="_modal">

        <form class="modal-content animate" method="post" id="email_form">
            <div class="imgcontainer">
                <span onclick="document.getElementById('login_modal').style.display='none'" class="close"
                    title="Close Modal">&times;</span>
                <img src="images/admin.jpeg" alt="Avatar" class="avatar">
            </div>
            <input type="hidden" name="_form" value="email">

            <div class="container">
                <label for="uname"><b>NITC Email</b></label>
                <input type="text" placeholder="Enter NITC Email ID" name="email" required>
                <?php
                    if(isset($_SESSION["error"])){
                        $error = $_SESSION["error"];
                        echo '<span style="color:red;">';echo $error; echo '</span>';
                        unset($_SESSION["error"]);
                    }
                ?>
                <input type="submit" class="btn btn-primary" value="RESET PASSWORD" name="submit_reset">
            </div>

            <div class="container">

                <span class="psw"> <a href="#"> Login</a></span>
            </div>
        </form>
    </div>
</body>

</html>