<?php
function display_header()
{
?>
  <header class="page-header" id="header"><br>
    <div class="container-fluid">
      <div class="row align-items-end">
        <div class="col">
          <img class="responsive" src="../images/logo.jpg">
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


  <nav class="navbar navbar-expand-lg">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <i class="material-icons" style="color: white;">menu</i>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
      <ul class="navbar-nav">
        <li class="nav-item"><a id='home' class="nav-link" href="home.php">HOME</a></li>
        <li class="nav-item"><a id='upcoming' class="nav-link" href="upcomingBookingsRegistrar.php">UPCOMING BOOKINGS <span class="badge badge-danger"><?php echo get_unalloted(); ?></span> </a></li>
        <li class="nav-item"><a id='past' class="nav-link" href="pastBookingsRegistrar.php">PAST BOOKINGS</a></li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
            <i class="material-icons">person</i>
          </a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="adminprofile.php">Change Password</a>
            <a class="dropdown-item" href="logout.php">Sign Out</a>
          </div>
        </li>
      </ul>
    </div>
  </nav>
<?php
}

function get_unalloted()
{
  include 'dbConfig.php';

  $sql = "SELECT COUNT(DISTINCT booking_id) as total FROM booked NATURAL join guests WHERE booking_status='WAITING APPROVAL' AND expected_checkin>now()";
  if ($res = mysqli_query($db, $sql))
    return mysqli_fetch_assoc($res)['total'];
  else
    return $db->error;
}

?>