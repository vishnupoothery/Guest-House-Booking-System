<?php
include('header.php');
include('dbConfig.php');


?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/mystyles.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

  <script src="../js/bootstrap.bundle.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/jquery.min.js"></script>
  <script src="../js/myjs.js"></script>
  <title>NITC GH</title>
</head>

<body>

  <div class="container">

  <select class="form-control" id="searchby">
          <option selected disabled>Search By</option>
          <option value='booking_id'>Booking ID</option>
          <option value='booking_status'>Booking Status</option>
          <option value='booking_by'>Booking By</option>
        </select>
   <input class="form-control" id="searchfor" type="text" placeholder="Enter" >

    <script>
      window.onbeforeunload = function() {
        localStorage.setItem("searchby", $('#searchby').val());
        localStorage.setItem("searchfor", $('#searchfor').val());

      }
      window.onload = function() {

        var searchby = localStorage.getItem("searchby");
        if (searchby !== null) $('#searchby').val(searchby);
        var searchfor = localStorage.getItem("searchfor");
        if (searchfor !== null) $('#searchfor').val(searchfor);

      }
    </script>
</body>

</html>