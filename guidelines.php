<?php
include 'checkLogin.php';
include 'header.php';
include 'dbConfig.php';
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/mystyles.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/myjs.js"></script>
    <title>NITC GH</title>



</head>

<body>
    <?php echo display_header();
    echo display_user_navbar(); ?>
    <script>
        activateTab('guide');
    </script>
    <div class="row justify-content-center">
        <ul>
            <li>All bookings are provisional and subject to availabliity.</li>
            <li>A user can make atmost <?php echo $NUM_BOOKINGS_PER_MONTH ?> bookings per month.</li>
            <li>A user can book for atmost <?php echo $NUM_OF_DAYS_PER_BOOKING;?> days at a time with a maximum of <?php echo $NUM_OF_ROOMS_PER_BOOKING; ?> rooms.</li>
            <li>The bookings can be made <?php echo $NUM_OF_DAYS_PRIOR; ?> days prior to check-in. </li>
        </ul>

    </div>
</body>

</html>