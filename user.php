
<?php
// Include calendar helper functions
include_once 'functions.php';
include('header.php');
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/mystyles.css">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open Sans">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"> </script>
    <script src="js/jquery.min.js"></script>
      <script src="js/myjs.js"></script>

      <script>
  $(function() {
    $( "#skills" ).autocomplete({
      source: 'search.php'
    });
  });


  </script>
    <?php include_once('functions.php'); ?>



    <title>NITC GH</title>



  </head>
  <body class="w3-light-grey">
 <?php echo display_header(); ?>

<nav class="navbar navbar-default"><ul class="nav nav-bar">
    <li class="active"><a
              href="user.php">HOME</a></li>
    <li><a href="upcomingbookings_user.php">UPCOMING BOOKINGS</a></li>
    <li><a href="past_bookings.php">PAST BOOKINGS</a></li>
    <li><a href="#menu3">GUIDELINES</a></li>
  </ul>
        </nav>


<div>
       <div class="tab-content">

    <div id="home" class="tab-pane fade in active" >
        <?php

if(isset($_POST['book_now']))
{

   ?>
 <div style="width:25%; margin:auto;">
           <form action="book.php?guestsno=<?php echo $_POST['guestsno']; ?>&checkin=<?php echo $_POST['checkin'];?>&checkout=<?php echo $_POST['checkout'];?>" id="guests_form" method="post">
  <div class="tab form-tab">

   <div class="form-group">
    <label for="roomsno">Number of Rooms Required</label>
    <input type="number" class="form-control" min="1" max="5" name="roomsno" required>
  </div>
<div class="form-group">
  <label for="purpose">Purpose</label>
  <select class="form-control" name="purpose">
    <option>Personal</option>
    <option>Official</option>

  </select>
</div>
<div class="form-group">
  <label for="payment">Payment Method</label>
  <select class="form-control" name="payment">
    <option>Self</option>
    <option>Guest</option>
      <option>Institute</option>

  </select>
</div>
</div>
            <?php  for($i=0;$i< $_POST['guestsno'];$i++) { ?>
<div class ="tab form-tab guests">
    <h3> Guest <?php echo $i +1 ?></h3>
         <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" name="name[]" required>
  </div>
                     <div class="form-group">
    <label for="rel">Relationship with Applicant</label>
    <input type="text" class="form-control" name="rel[]" required>
  </div>
                     <div class="form-group">
    <label for="contact">Contact</label>
    <input type="text" class="form-control" name="contact[]" required>
  </div>
        </div> <?php } ?>
  <div style="overflow:auto;">
    <div style="float:right;">
      <button type="button" id="prevBtn"  class="btn btn-primary" onclick="nextPrev(-1)">Previous</button>
      <button type="button" id="nextBtn"  class="btn btn-primary" onclick="nextPrev(1)">Next</button>
    </div>
  </div>
<div style="text-align:center;margin-top:40px;">
 <?php  for($i=0;$i<= $_POST['guestsno'];$i++) { ?>
    <span class="step"></span>
<?php } ?>
  </div>

<script>


var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab);
function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("form-tab");
  // Exit the function if any field in the current tab is invalid:


 if (n==1 && !validateForm(currentTab)) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
  //  document.getElementById("book_form").submit();

    confirmBook(<?php echo $_POST['guestsno'] ?>);
currentTab=currentTab-n;
  }
  // Otherwise, display the correct tab:

  showTab(currentTab);
}</script>
        </form>

        </div>

          <div class="modal" id="confirm_modal">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
       <span onclick="document.getElementById('confirm_modal').style.display='none'" class="close" title="Close Modal">&times;</span>
          <h4 class="modal-title">Booking for <?php echo $_POST['checkin']; ?> to  <?php echo $_POST['checkout']; ?></h4>
        </div>
        <div class="modal-body">

          <div id="guests_info"> </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" onclick="document.getElementById('confirm_modal').style.display='none'" style="float:left;" >Edit</button>
            <button class="btn btn-default" onclick="document.getElementById('guests_form').submit();
" style="float:right"> Confirm</button>
        </div>
      </div>

    </div>
  </div><?php
}
else {
    ?>


<div class="row">
      <div class="col-sm-7" >
        <div id="calendar_div">
            <?php echo getCalender(); ?>
        </div>
    </div>
    <div class="col-sm-4" >
        <form action="user.php" style="padding:120px 0;" onsubmit="validateDates();"  id="book_form" method="post" >

            <div class="form-group">
    <label for="checkin">CHECK-IN</label>
    <input type="date" class="form-control" id="checkin" name="checkin" required>
  </div>
  <div class="form-group">
    <label for="checkout">CHECK-OUT</label>
    <input type="date" class="form-control" id="checkout" name="checkout" required>
  </div>
               <div class="form-group">
    <label for="guestsno">Number of Guests</label>
    <input type="number" min="1" class="form-control" name="guestsno" required>
  </div>
    <button type="submit"  name="book_now" class="btn btn-primary">Book Now </button>
</form>

    </div>

</div>
        <?php } ?>




    </div>


    <div id="menu1" class="tab-pane fade">
      <h3>Upcoming</h3>
    </div>
    <div id="menu2" class="tab-pane fade">
      <h3>Past</h3>
    </div>
    <div id="menu3" class="tab-pane fade">
      <h3>FAQ</h3>
    </div>
=

    </div></div>

      <script>
// Get the modal
var modal = document.getElementById('confirm_modal');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

</script>

</body>
</html>

