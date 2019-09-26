<?php
   include('session.php');
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
   <link rel="stylesheet" href="css/mystyles.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <title>NITC GH</title>
  </head>
<body class="w3-light-grey">
    <header class="page-header" id="header">
      <div class="container-fluid" >

          <div class="row">
    <div class="col-sm-6">
     <img  src="images/logo.jpg">
    </div>
    <div class="col-sm-6"  >



      <div class="row"> <h3 style="color:#23aacc; float:right;">GUEST HOUSE BOOKING PORTAL</h3></div>


    </div>
  </div>

           </div>
      </header>

  <div class="container" style="margin=0px;">

  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">HOME</a></li>
    <li><a data-toggle="tab" href="#menu1">UPCOMING BOOKINGS</a></li>
    <li><a data-toggle="tab" href="#menu2">PAST BOOKINGS</a></li>
    <li><a data-toggle="tab" href="#menu3">ROOMS</a></li>
       <li><div class="dropdown"><a class="dropdown-toggle"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   <span class= "glyphicon glyphicon-user" style="color:blue;"></span>
  </a>
  <div  class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="#">My Profile</a>
    <a class="dropdown-item" href="#addadmin">Add Admin</a>
    <a class="dropdown-item" href="logout.php">Sign Out</a>
  </div></div> </li>
  </ul>


  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
     <div class="row">

        <div id="calendar_div">
            <?php
            include_once("functions.php");
            echo getCalender(); ?>
        </div>


</div>
    </div>
    <div id="menu1" class="tab-pane fade">
      <h3>Upcoming</h3>
    </div>
    <div id="menu2" class="tab-pane fade">
      <h3>Past</h3>
    </div>
    <div id="menu3" class="tab-pane fade">
      <h3>ROOMS</h3>
    </div>
    <div id="addadmin" class="tab-pane fade">
      <h1>h</h1></div>
  </div>
</div>
