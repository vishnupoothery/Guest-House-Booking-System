<?php
include 'checkLogin.php';
include 'header.php';
include 'dbConfig.php';
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

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.min.js"></script>
  <script src="js/myjs.js"></script>
  <title>NITC GH</title>



</head>

<body>
  <?php echo display_header();
  echo display_user_navbar(); ?>
  <script>
    activateTab('home');
  </script>
<?php
  $user = $_SESSION['email'];
  $sql = "SELECT * FROM booked WHERE booked_by='" . $user . "' and  DATE_FORMAT(booking_date,'%M %Y') = DATE_FORMAT(now(),'%M %Y')";
  $res = mysqli_query($db, $sql);
  if ($res)
  {
      $num = $res->num_rows;
      if ($num == $NUM_BOOKINGS_PER_MONTH)
      {
        $_SESSION['exceeded']=true;
        header('location:user.php');
      }
      
  }
  else
  {
      echo $db->error;
  }

  $checkin=$_POST['checkin'];
  $checkout=$_POST['checkout'];

  $sql="SELECT room_id FROM rooms WHERE room_id NOT IN 
  (SELECT room_id FROM guests WHERE room_id!=0 
  AND ((actual_checkout != NULL AND actual_checkin< '" . $checkout . "' AND actual_checkout >'" . $checkin . "' ) OR
      (expected_checkin < '" . $checkout . "' AND expected_checkout >'" . $checkin . "' )))";
  $res=mysqli_query($db,$sql);
  if($res)
  {
    $free=$res->num_rows;
  }
  else
  {
    $db->error;
  }

?>



  <br>
  <div class="row justify-content-center">
    <form action="book.php?guestsno=<?php echo $_POST['guestsno']; ?>&checkin=<?php echo $_POST['checkin']; ?>&checkout=<?php echo $_POST['checkout']; ?>" id="guests_form" method="post">
      <div class="tab form-tab">
        <div class="form-group position-relative">
          <label for="roomsno">Number of Rooms Required</label>
          <input type="number" class="form-control position-relative" min="1" max=<?php echo min($NUM_OF_ROOMS_PER_BOOKING,$free) ;?> name="roomsno" required 
          onchange="validateRooms(<?php echo $NUM_OF_GUESTS_PER_ROOM ?>, <?php echo $NUM_OF_ROOMS_PER_BOOKING ?>, <?php echo $free ?>);">
          <div id='roomnumwarning' class="invalid-tooltip"> </div>
        </div>
        <div class="form-group">
          <label for="purpose">Purpose</label>
          <select class="form-control" name="purpose">
            <option>Personal</option>
            <option>Official</option>
          </select>
        </div>
        <div class='form-group' id='official-purpose'>
          <input type="text" name="purpose-desc" id="purpose-desc" placeholder="If Official, specify ">
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
      <?php for ($i = 0; $i < $_POST['guestsno']; $i++) { ?>
        <div class="tab form-tab guests">
          <h3> Guest <?php echo $i + 1 ?></h3>
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name[]" required>
          </div>
          <div class="form-group">
            <label for="rel">Relationship with Applicant</label>
            <input type="text" class="form-control" name="rel[]" required>
          </div>
          <div class="form-group position-relative">
            <label for="contact">Mobile Number</label>
            <input type="text" class="form-control" name="contact[]" required onchange="validateContact(<?php echo $i ?>);">
            <div class="invalid-tooltip">Please enter valid contact</div>

          </div>
        </div> <?php } ?>
      <div style="overflow:auto;">
        <div style="float:right;">
          <button type="button" id="prevBtn" class="btn btn-prim" onclick="nextPrev(-1)">Previous</button>
          <button type="button" id="nextBtn" class="btn btn-prim" onclick="nextPrev(1)">Next</button>
        </div>
      </div>
      <div style="text-align:center;margin-top:40px;">
        <?php for ($i = 0; $i <= $_POST['guestsno']; $i++) { ?>
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


          if (n == 1 && !validateForm(currentTab)) return false;
          // Hide the current tab:
          x[currentTab].style.display = "none";
          // Increase or decrease the current tab by 1:
          currentTab = currentTab + n;
          // if you have reached the end of the form...
          if (currentTab >= x.length) {
            // ... the form gets submitted:
            //  document.getElementById("book_form").submit();

            confirmBook(<?php echo $_POST['guestsno'] ?>);
            currentTab = currentTab - n;
          }
          // Otherwise, display the correct tab:

          showTab(currentTab);
        }
      </script>
    </form>

  </div>

  <div class="modal" id="confirm_modal">


    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <span onclick="document.getElementById('confirm_modal').style.display='none'" class="close" title="Close Modal">&times;</span>
        <h4 class="modal-title">Booking for <?php echo date('F jS Y', strtotime($_POST['checkin'])); ?> to <?php echo date('F jS Y', strtotime($_POST['checkout'])); ?></h4>
      </div>

      <div class="modal-body">

        <div id="guests_info"> </div>
      </div>

      <div class="modal-footer">
        <button type="button" id="editButton" class="btn btn-prim" onclick="document.getElementById('confirm_modal').style.display='none'" style="float:left;">Edit</button>
        <button type="button" class="btn btn-prim" onclick="confirmModal(this);" style="float:right"> Confirm</button>
      </div>

    </div>

  </div>


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

</html>