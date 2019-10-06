<?php
function display_header()
{
    ?>
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

<?php
}

function get_unalloted()
{

    include 'dbConfig.php';
    $sql="SELECT COUNT(*) as total FROM booked WHERE booking_status='WAITING APPROVAL'";
    if($res=mysqli_query($db,$sql))
     return mysqli_fetch_assoc($res)['total'];
    else
        return $db->error;
}



function display_admin_navbar()
{
    ?>

  <div class="container" >
<nav class="navbar">
<ul class="nav nav-bar">
    <li><a id='home' class="navtab" href="admin.php">HOME</a></li>
    <li><a id='upcoming' class="navtab" href="upcomingbookings_admin.php">UPCOMING BOOKINGS <span class="badge badge-primary"><?php echo get_unalloted(); ?></span> </a></li>
    <li><a id='past' class="navtab"  href="past_bookings_admin.php">PAST BOOKINGS</a></li>
    <li><a  id='rooms' class="navtab"  href="rooms.php">ROOMS</a></li>
    </ul><ul class="nav navbar-right">
    <li><div class="dropdown"><a  class="navtab" class="dropdown-toggle"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   <span class= "glyphicon glyphicon-user" style="color:white;"></span>
  </a>
  <div  class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="adminprofile.php">My Profile</a>
    <a class="dropdown-item" href="addadmin.php">Add Admin</a>
    <a class="dropdown-item" href="logout.php">Sign Out</a>
  </div></div> </li>
  </ul>
      </nav>
       <?php
}


function display_user_navbar()
{?>
  <nav class="navbar" >
    <ul class="nav nav-bar" >
    <li  ><a class="navtab" id="home" href="user.php">HOME</a></li>
    <li><a class="navtab" id="upcoming" href="upcomingbookings_user.php">UPCOMING BOOKINGS</a></li>
    <li><a class="navtab" id="past" href="past_bookings.php">PAST BOOKINGS</a></li>
    <li><a class="navtab" id="guide" href="#menu3">GUIDELINES</a></li>

  </ul>
      <ul class="nav navbar-right">
              <li><a class="navtab" href="#menu4">SIGN OUT</a></li>
      </ul>
    </nav>

      <?php

}

?>



