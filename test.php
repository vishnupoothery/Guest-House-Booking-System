          <?php
// Include calendar helper functions
include_once 'functions.php';

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
    <title>NITC GH</title>
  </head>
  <body>




      <header class="page-header" id="header">
      <div class="container-fluid" >
 <a class="admin_login"  onclick="document.getElementById('login_modal').style.display='block'" style="float:right;">Admin Login</a>
          <div class="row">
    <div class="col-sm-6">
     <img  src="images/logo.jpg">
    </div>
    <div class="col-sm-6" >

      <h3 style="color:#23aacc; float:right;">GUEST HOUSE BOOKING PORTAL</h3>
    </div>
  </div>

           </div>
      </header>



<br>
          <div class='col-sm-3'></div>

     <div id="calendar_div"  >
            <?php echo getCalender(); ?>
        </div>

     <div class=".container-fluid">
         <div style=" margin-top:25px;" align="center">            <a class="example_f" href="user.php" >
             <span align="center" style="width: 90%;">BOOK NOW</span>
          </a>
         </div>

    </div>


  </body>
</html>

