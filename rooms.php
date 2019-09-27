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
    <li><a   href="#menu1">UPCOMING BOOKINGS</a></li>
    <li><a   href="#menu2">PAST BOOKINGS</a></li>
    <li><a class="active" data-toggle="tab"  href="rooms.php">ROOMS</a></li>
       <li><div class="dropdown"><a class="dropdown-toggle"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   <span class= "glyphicon glyphicon-user" style="color:blue;"></span>
  </a>
  <div  class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="adminprofile.php">My Profile</a>
    <a class="dropdown-item" href="addadmin.php">Add Admin</a>
    <a class="dropdown-item" href="logout.php">Sign Out</a>
  </div></div> </li>
  </ul>
<br>
 <div class="tab-content">
    <div  class="tab-pane fade in active">

         <form  method="post">
     <div class="row">
 <div class="col-sm-4">

     <select class="form-control" id="rooms_dropdown" name="rooms_dropdown" onchange="display_subdropdown()" >
    <option value="all" > All Rooms</option>
    <option value="ac"> AC</option>
    <option value="type"> Room Type </option>
    <option value="capacity"> Capacity</option>
         </select>
             </div>
<div class="col-sm-4">
    <select  class="form-control" id="rooms_subdropdown" name="rooms_subdropdown">

</select>
    </div>
    <div class="col-sm-2"> <button type="submit" class="btn btn-primary" name="table_filter">Go</button></div>

             <div class="col-sm-2" style="float:right;"> <span  class="glyphicon glyphicon-plus-sign"  onclick="document.getElementById('addroom_modal').style.display='block'"> Add Room</span></div>
       </div>
     </form>
    <br>






<?php
      include('dbConfig.php');
    if (isset($_POST['addroom_button']))
    {
        $sql="INSERT INTO rooms (location,room_num,ac,rent,type,capacity) VALUES ('GH','".$_POST['room_num']."','".$_POST['ac']."','".$_POST['rent']."','".$_POST['type']."','".$_POST['capacity']."')";

if (mysqli_query($db,$sql) == TRUE) {
    echo "<div class='alert alert-success alert-dismissible'>
      <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>

  <strong>Success!</strong> New room Added!
</div>";
} else {
    //echo $db->error;;
    echo "<div class='alert alert-warning alert-dismissible'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>

  <strong>Error!</strong> New room not Added.
</div>
" ;
}
    }
    if (isset($_POST['rooms_subdropdown']))

        $sql= "SELECT * FROM rooms WHERE ".$_POST['rooms_dropdown']."='".$_POST['rooms_subdropdown']."'";
    else
        $sql="SELECT * FROM rooms";

    $result = mysqli_query($db,$sql);
    echo "<table align='center' class='table table-hover'>";
echo "<tr><th>LOCATION</th><th>ROOM NUM</th><th>AC</th><th>TYPE</th><th>RENT</th><th>CAPACITY</th><th>Delete</th></tr> ";
    if($result){
         while($rr=mysqli_fetch_array($result))
		{
		echo "<tr><td>";
		echo $rr['location'];
        echo "</td><td>";
		echo $rr['room_num'];
        echo "</td><td>";
		echo $rr['ac'];
        echo "</td><td>";
		echo $rr['type'];
        echo "</td><td>";
		echo $rr['rent'];
        echo "</td><td>";
		echo $rr['capacity'];
        echo "</td><td><a href='deleteroom.php?room_id=";
        echo $rr['room_id'];
        echo "'> <span class='glyphicon glyphicon-remove'></span></a>";
		echo "</td></tr>";
		}
    }

		echo "</table>";

?>
</div>
    </div>

  </div>
    <!-----------ADD ROOM---------->

      <div id="addroom_modal" class="modal">

  <form class="modal-content animate"  method="post" action="rooms.php">
    <div class="imgcontainer">
      <span onclick="document.getElementById('addroom_modal').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="images/admin.jpeg" alt="Avatar" class="avatar">
    </div>

    <div class="container" >
        <div class="form-group">
         <label for="room_num"><b>Room Number</b></label><br>
      <input  name="room_num" required></div>
          <div class="form-group">
        <label for="type">Type</label>
     <select class="form-control" name="type">
        <option value="deluxe">Deluxe</option>
        <option value="super deluxe">Super Deluxe</option>
        <option value="vip">VIP</option>
        </select>
        </div>
          <div class="form-group">
         <label for="ac">AC</label>
     <select class="form-control" name="ac">
        <option value="ac">AC</option>
        <option value="nonac">Non AC</option>

        </select>
        </div>
          <div class="form-group"><label for="rent">Rent</label><br>
        <input type="number" name="rent" required></div>


       <div class="form-group">  <label for="capacity">Capacity</label><br>
        <input type="number" name="capacity" required></div>

      <div class="form-group">
            <button type="submit" name="addroom_button" class="btn btn-primary"> Add Room</button>
</div>


    </div>





  </form>
</div>

    </body>
</html>
