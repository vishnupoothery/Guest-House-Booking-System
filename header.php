<?php

//CONSTANTS

$NUM_OF_ROOMS_PER_BOOKING=5;
$NUM_BOOKINGS_PER_MONTH=4;
$NUM_OF_DAYS_PER_BOOKING=7;
$NUM_OF_GUESTS_PER_BOOKING=10;
$NUM_OF_DAYS_PRIOR=28;
$NUM_OF_GUESTS_PER_ROOM=2;





function display_header()
{
  ?>
  <header class="page-header" id="header"><br>
    <div class="container-fluid">
      <div class="row align-items-end">
        <div class="col">
          <img src="images/logo.jpg">
        </div>
        <div class="col">
          <span class="heading">GUEST HOUSE BOOKING PORTAL</span>
        </div>
      </div><br>
    </div>
  </header>
<?php
}





function display_user_navbar()
{ ?>
  <nav class="navbar navbar-expand-sm justify-content-center">
    <ul class="navbar-nav">
      <li class="nav-item"><a class="nav-link" id="home" href="user.php">HOME</a></li>
      <li class="nav-item"><a class="nav-link" id="upcoming" href="upcomingbookings_user.php">UPCOMING BOOKINGS</a></li>
      <li class="nav-item"><a class="nav-link" id="past" href="past_bookings.php">PAST BOOKINGS</a></li>
      <li class="nav-item"><a class="nav-link" id="guide" href="guidelines.php">GUIDELINES</a></li>
   </ul>
    <ul class="navbar-nav navbar-right">
      <li class="nav-item"><a class="nav-link" href="logout.php">SIGN OUT</a></li>
    </ul>
  </nav><br>

<?php

}

?>