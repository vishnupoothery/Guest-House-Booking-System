<?php
include('session.php');
include('header.php');
include_once("functions.php");

?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/mystyles.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/jquery.min.js"></script>
  <script src="../js/myjs.js"></script>
</head>

<body >
  <?php echo display_header();
  echo display_admin_navbar(); ?>

  <script>
    activateTab('home');
  </script>

  <div class="tab-content">
    <div id="home" >
      <div class="row justify-content-center">

        <div id="calendar_div">
          <?php
          echo getCalender(); ?>
        </div>


      </div>
    </div>

  </div>
  </div>
</body>

</html>