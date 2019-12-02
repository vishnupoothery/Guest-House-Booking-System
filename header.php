<?php
function display_header()
{
  ?>
  <header class="page-header" id="header"><br>
    <div class="container-fluid">
      <div class="row align-items-end">
        <div class="col-6">
          <img src="../images/logo.jpg">
        </div>
        <div class="col-6">
          <h3 class="heading">GUEST HOUSE BOOKING PORTAL</h3>
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
      <li class="nav-item"><a class="nav-link" id="guide" href="#menu3">GUIDELINES</a></li>
   </ul>
    <ul class="navbar-nav navbar-right">
      <li class="nav-item"><a class="nav-link" href="logout.php">SIGN OUT</a></li>
    </ul>
  </nav><br>

<?php

}

?>