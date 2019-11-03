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
              <li><a class="navtab" href="logout.php">SIGN OUT</a></li>
      </ul>
    </nav>

      <?php

}

?>



