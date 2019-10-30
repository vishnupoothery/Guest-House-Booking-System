<?php
   include('session.php');
 include ('../header.php')
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
   <link rel="stylesheet" href="../css/mystyles.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
   <script src="../js/myjs.js"></script>
    <title>NITC GH</title>
  </head>
<body class="w3-light-grey">
<?php echo display_header();
      echo display_admin_navbar(); ?>

<script>activateTab('home');</script>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
     <div class="row">
  <div class='col-sm-2'></div>

        <div id="calendar_div">
            <?php
            include_once("../functions.php");
            echo getCalender(); ?>
        </div>


</div>
    </div>

  </div>
</div>
    </body>
</html>
