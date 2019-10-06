<?php
   include('session.php');

    include('header.php');


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
      <script src="js/myjs.js"></script>

    <title>NITC GH</title>
  </head>
<body class="w3-light-grey">
  <?php echo display_header(); ?>

  <div class="container" style="margin=0px;">
<ul class="nav nav-tabs">
    <li><a  href="admin.php">HOME</a></li>
    <li><a   href="upcomingbookings_admin.php">UPCOMING BOOKINGS</a></li>
    <li><a class="active"   href="past_bookings_admin.php">PAST BOOKINGS</a></li>
    <li><a href="rooms.php">ROOMS</a></li>
       <li><div class="dropdown"><a class="dropdown-toggle"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   <span class= "glyphicon glyphicon-user" style="color:blue;"></span>
  </a>
  <div  class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="adminprofile.php">My Profile</a>
    <a class="dropdown-item" href="addadmin.php">Add Admin</a>
    <a class="dropdown-item" href="logout.php">Sign Out</a>
  </div></div> </li>
  </ul>


       <?php

      include('dbConfig.php');
      $sql="SELECT DISTINCT `booking_id` FROM guests WHERE checkout<DATE_FORMAT(now(),'%Y%c%d') OR room_id=-1
";// and booked_by=user_id;

      $result = mysqli_query($db,$sql);
      echo "<table class='table table-hover'> <tr><th>BOOKING DATE </th><th>BOOKED BY</th><th>CHECKIN</th><th>CHECKOUT</th><th>PURPOSE</th><th>  BOOKING STATUS</th><th></th></tr>";
       if($result)
       {
            while($rr=mysqli_fetch_array($result))
            {   $get_booking_data="SELECT DATE_FORMAT(booking_date,'%d-%m-%y') as booking_date,booked_by,purpose,booking_status FROM booked WHERE booking_id=".$rr['booking_id']."";
                $booking_data_res= mysqli_query($db,$get_booking_data);
                $booking_data=mysqli_fetch_assoc($booking_data_res);
             $get_guest_data="SELECT DATE_FORMAT(checkin,'%d-%m-%y') as checkin,DATE_FORMAT(checkout,'%d-%m-%y') as checkout FROM guests WHERE booking_id=".$rr['booking_id']."";
             $guest_data_res=mysqli_query($db,$get_guest_data);
             $guest_data=mysqli_fetch_assoc($guest_data_res);
                echo "<tr class='collapserow' onclick='toggle_collapse(";
                echo $rr['booking_id'];
                echo ")'><td>";
                echo $booking_data['booking_date'];
             echo "</td><td>";
             echo $booking_data['booked_by'];
             echo "</td><td>";
             echo $guest_data['checkin'];
             echo "</td><td>";
             echo $guest_data['checkout'];
             echo "</td><td>";
              echo $booking_data['purpose'];
             echo "</td><td>";
             echo $booking_data['booking_status'];
             echo "</td></tr><tr id='collapse";
             echo $rr['booking_id'];
             echo "' class='collapse out'><td colspan=4>";

             $get_guest_data="SELECT * FROM guests WHERE booking_id=".$rr['booking_id']."";
             $guest_data_res=mysqli_query($db,$get_guest_data);

             echo "<table class='table'>";
             while($guest_data=mysqli_fetch_array($guest_data_res))
             {
                 echo "<tr><td>";
                 echo $guest_data['name'];
                 echo "</td><td>";
                 echo $guest_data['relation'];
                 echo "</td><td>";
                 echo $guest_data['contact'];
                 echo "</td><td>";
                 $get_room_data="SELECT room_num FROM rooms where room_id=".$guest_data['room_id']."";
                 $room_data_res=mysqli_query($db,$get_room_data);
                 $room_data=mysqli_fetch_assoc($room_data_res);
                 echo $room_data['room_num'];
                 echo "</td><td></tr>";

             }


             echo "</table>";


             echo "</td></tr>";


            }

       }
      echo "</table>";


?>
    </div>
    </body>
</html>
