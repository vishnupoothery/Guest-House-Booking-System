<?php
function display_header()
{
  ?>
  <header class="page-header" id="header"><br>
    <div class="container-fluid">
      <div class="row align-items-end">
        <div class="col">
          <img src="../images/logo.jpg">
        </div>
        <div class="col">
          <span class="heading">GUEST HOUSE BOOKING PORTAL</span>
        </div>
      </div><br>
    </div>
  </header>

<?php
}



function display_admin_navbar()
{
  ?>

  <div class="container">
    <nav class="navbar navbar-expand-sm justify-content-center">
      <ul class="navbar-nav">
        <li class="nav-item"><a id='home' class="nav-link" href="home.php">HOME</a></li>
        <li class="nav-item"><a id='upcoming' class="nav-link" href="upcomingBookingsRegistrar.php">UPCOMING BOOKINGS <span class="badge badge-danger"><?php echo get_unalloted(); ?></span> </a></li>
        <li class="nav-item"><a id='past' class="nav-link" href="pastBookingsRegistrar.php">PAST BOOKINGS</a></li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle"  href="#"  id="navbardrop" data-toggle="dropdown">
          <i class="material-icons">person</i>
          </a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="adminprofile.php">My Profile</a>
            <a class="dropdown-item" href="logout.php">Sign Out</a>
          </div>

        </li>
      </ul>
    </nav>
  <?php
  }

  function get_unalloted()
  {

    include 'dbConfig.php';
    $sql = "SELECT COUNT(DISTINCT booking_id) as total FROM booked NATURAL join guests WHERE booking_status='WAITING APPROVAL' AND expected_checkin>DATE_FORMAT(now(),'%Y%c%d')";
    if ($res = mysqli_query($db, $sql))
      return mysqli_fetch_assoc($res)['total'];
    else
      return $db->error;
  }

  ?>

