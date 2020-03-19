<?php
include 'checkLogin.php';
include 'functions.php';
include 'header.php';
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
    <script src="js/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/myjs.js"></script>

    <title>NITC GH</title>



</head>

<body>
    <?php echo display_header();
  echo display_user_navbar(); ?>

    <script>
    activateTab('home');
    </script>
    <div>
        <div class="tab-content">
            <div id="home">
                <div class="row justify-content-center">
                    <div class="col-7">
                        <div id="calendar_div">
                            <?php echo getCalender(); ?>
                        </div>
                    </div>
                    <div class="col-4">
                        <form action="newBooking.php" style="padding:120px 0;" onsubmit="return validateDates();"
                            id="book_form" method="post">

                            <div class="form-group position-relative">
                                <label for="checkin">CHECK-IN</label>
                                <input type="date" class="form-control" id="checkin" name="checkin" required onchange="validateCheckin();">
                                <div class="invalid-tooltip">Please enter valid check-in date</div>
                            </div>
                            <div class="form-group position-relative">
                                <label for="checkout">CHECK-OUT</label>
                                <input type="date" class="form-control" id="checkout" name="checkout" required onchange="validateCheckout();">
                                <div class="invalid-tooltip">Please enter valid check-out date</div>
                            </div>
                            <div class="form-group">
                                <label for="guestsno">Number of Guests</label>
                                <input type="number" min="1" class="form-control" name="guestsno" required>
                                <span style="font-size:80%;opacity:0.7;">Children above 12 years should be included </span>
                            </div>
                            <button type="submit" name="book_now" class="btn btn-prim">Book Now </button>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>

</body>

</html>


