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
<?php echo display_header();
      echo display_admin_navbar(); ?>

<script>activateTab('upcoming');</script>

    <?php
      include('dbConfig.php');
      $sql="SELECT DISTINCT `booking_id` FROM guests WHERE checkin>DATE_FORMAT(now(),'%Y%c%d') AND room_id!=-1
";

      $result = mysqli_query($db,$sql);
      echo "<table class='table table-hover'> <tr><th>BOOKING DATE </th><th>BOOKED BY</th><th>CHECKIN</th><th>CHECKOUT</th><th>PURPOSE</th><th>  BOOKING STATUS</th><th></th></tr>";
       if($result)
       {
            while($rr=mysqli_fetch_array($result))
            {   $get_booking_data="SELECT booked_by,DATE_FORMAT(booking_date,'%d-%m-%y') as booking_date,booked_by,purpose,booking_status,no_guests,no_rooms FROM booked WHERE booking_id=".$rr['booking_id']."";
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

             $checkin= $guest_data['checkin'];
             $checkout=$guest_data['checkout'];
             $get_guest_data="SELECT * FROM guests WHERE booking_id=".$rr['booking_id']."";
             $guest_data_res=mysqli_query($db,$get_guest_data);

             echo "<table class='table'>";
             echo "<tr><td>Guests: ";
             echo $booking_data['no_guests'];
             echo "</td><td> Rooms required: ";
             echo $booking_data['no_rooms'];
             echo "</td></tr>";

             while($guest_data=mysqli_fetch_array($guest_data_res))
             {
                 echo "<tr><td>";
                 echo $guest_data['name'];
                 echo "</td><td>";
                 echo $guest_data['relation'];
                 echo "</td><td>";
                 echo $guest_data['contact'];
                 echo "</td></tr>";

             }


             echo "</table>";

             if($booking_data['booking_status']=='WAITING APPROVAL')
             {
                 echo "<div class='row'><div class='col-sm-4'></div><div class='col-sm-2'><button class='btn btn-prim' onclick=\"document.getElementById('allotrooms";
                 echo $rr['booking_id'];
                 echo "').style.display='block';this.style.display='none';\">Allot Rooms </button></div>";

                 $get_room_data=    "SELECT room_id, room_num FROM rooms WHERE room_id NOT IN (SELECT room_id FROM guests WHERE room_id!=0 AND DATE_FORMAT(checkin,'%d-%m-%y')< '".$checkout."' AND DATE_FORMAT(checkout,'%d-%m-%y') >'".$checkin."' )";




                 echo "<form action='allotroom.php?booking_id=";
                 echo $rr['booking_id'];
                 echo "' style='display:none;' id='allotrooms";
                 echo $rr['booking_id'];
                 echo "' method='post'><div class='col-sm-5'><label>Hold down Ctrl key to select multiple rooms</label><select multiple name='allotedrooms[]' class='form-control' >";
                 $room_data_res=mysqli_query($db,$get_room_data);
                 while($room_data=mysqli_fetch_array($room_data_res))
                 {
                     echo "<option value='";
                     echo $room_data['room_id'];
                     echo "'>";
                     echo $room_data['room_num'];
                     echo "</option>";
                 }


                echo "</select></div><div class='col-sm-1'><button class='btn btn-prim' type='submit'>Allot</button></div></form></div>";
             }
             if ($booking_data['booking_status']!='CANCELLED')
            { echo "<button style='float:right;' type='button' class='btn btn-prim'><a style='color:white;text-decoration:none;' onclick=\"return confirm('Are you sure you want to cancel');\" href='cancel_booking.php?booking_id=";
             echo $rr['booking_id'];
             echo "&booking_status=REJECTED'>Cancel Booking</a></button>";}

             if (strpos($booking_data['booking_status'],'ALLOTED')!==false )
             {
               $get_room_data="SELECT room_num FROM rooms WHERE room_id IN (SELECT room_id FROM guests WHERE booking_id=".$rr['booking_id'].")";
              $room_data_res=mysqli_query($db,$get_room_data);
                 echo "The alloted room(s) are: ";
                 while($room_data=mysqli_fetch_array($room_data_res))
                 {
                     echo $room_data['room_num'];

                 }
             }

             echo "</td></tr>";


            }

       }
      echo "</table>";

  /* SELECT room_id, room_num FROM rooms WHERE room_id NOT IN (SELECT room_id ,  DATE_FORMAT(checkin,'%d-%m-%y') as checkin,   DATE_FORMAT(checkout,'%d-%m-%y') as checkout FROM guests WHERE room_id!=0 AND DATE_FORMAT(checkin,'%d-%m-%y')<11-10-19 AND DATE_FORMAT(checkout,'%d-%m-%y') > 07-10-19) */
?>



    </div>
    </body>
</html>
