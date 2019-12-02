<?php
function display_header()
{
  ?>
  <header class="page-header" id="header"><br>
    <div class="container-fluid">

      <div class="row align-items-end">
        <div class="col-6">
          <img src="images/logo.jpg">
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
  <nav class="navbar">
    <ul class="nav nav-bar">
      <li><a class="navtab" id="home" href="user.php">HOME</a></li>
      <li><a class="navtab" id="upcoming" href="upcomingbookings_user.php">UPCOMING BOOKINGS</a></li>
      <li><a class="navtab" id="past" href="past_bookings.php">PAST BOOKINGS</a></li>
      <li><a class="navtab" id="guide" href="#menu3">GUIDELINES</a></li>

    </ul>
    <ul class="nav navbar-right">
      <li><a class="navtab" href="logout.php">SIGN OUT</a></li>
    </ul>
  </nav>

<?php

}

?>