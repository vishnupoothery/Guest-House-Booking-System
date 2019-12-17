<?php
include('header.php');
include('dbConfig.php');


?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/mystyles.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.min.js"></script>
  <script src="js/myjs.js"></script>
  <title>NITC GH</title>
</head>

<body>

  <div class="container">
    <h2>Modal Example</h2>
    <!-- Button to Open the Modal -->
    <button type="button" class="btn btn-primary" onclick="openCheckIn();">
      Open modal
    </button>

    <div id="mymodal" class="modal">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">CHECK-IN</h4>
          <span class="close" onclick="document.getElementById('mymodal').style.display='none';">&times;</span>
        </div>
        <form method="post" id="checkin">
          <div class="modal-body">
            <div class='form-group'>
              <label for='date'>DATE</label><br>
              <input type="date" name='date' id='date'>
            </div>
            <div class='form-group'>
              <label for='time'>TIME</label><br>
              <input type="time" name='time' id='time'>
            </div>
          </div>
          <div class="modal-footer"> <input class='btn btn-prim' type="submit" value='CHECK IN'>
          </div>

        </form>
      </div>
      <script>
        function setDatetime() {
          var now = new Date();
          var day = ("0" + now.getDate()).slice(-2);
          var month = ("0" + (now.getMonth() + 1)).slice(-2);
          var today = now.getFullYear() + "-" + (month) + "-" + (day);
          document.getElementById('date').value = today;
          var currentTime = now.getHours() + ':' + now.getMinutes();
          document.getElementById('time').value = currentTime;
        }

        function openCheckIn() {
          setDatetime();
          document.getElementById('mymodal').style.display = 'block';


        }
        $(document).ready(function(e)
        {
          $("#checkin").submit(function(e) {
            e.preventDefault();
            var values = $(this).serialize();
            var ajaxRequest = $.ajax({
              url: "checkin.php",
              type: "post",
              data: values
            });
            ajaxRequest.done(function (response, textStatus, jqXHR){
            // Show successfully for submit message
            $("#mymodal").css('display','none');
            });

            /* On failure of request this function will be called  */
            ajaxRequest.fail(function (){

            // Show error
            //$("#result").html('There is error while submit');
            });

          });


        }
         
        )
      </script>
</body>

</html>