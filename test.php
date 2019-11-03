<?php 
include 'mail/mail.php';
include 'dbConfig.php';

$message = "<html>
<div style='width:50%;text-align:center;position:relative;margin-left:auto;margin-right:auto'>


<h3 style='color:#23aacc;'>NIT-C GUEST HOUSE BOOKING</h3>


<h3><b>Your booking ID is </b></h3>
<table border=0>
  <tr>
  <td style='height: 100px;
   width: 25%;
'>
  <div style='font-size: 25px;
font-weight:  bold;
text-align: center;
margin-left: auto;
margin-right: auto;
color: #00c434;
border-style: dashed;
border-color: #00c434;
'>
    ROOM ALLOTED
      </div>
    </td>
    <td> <div style='margin-left:20px;'>
    Checkin : <br>
    Checkout : <br>
      Rooms: <br>
    </div>
    </td>
  </tr>
  
</table>

</div>

</html>";
$toMail = "jyothsnashaji99@gmail.com";
$subject = "Room Alloted";
echo sendMail($toMail,$subject,$message);

?>

<html>
<div style='width:50%;text-align:center;position:relative;margin-left:auto;margin-right:auto'>


<h3 style='color:#23aacc;'>NIT-C GUEST HOUSE BOOKING</h3>


<h3><b>Your booking ID is </b></h3>
<table border=0>
  <tr>
  <td style='height: 100px;
   width: 25%;
'>
  <div style='font-size: 25px;
font-weight:  bold;
text-align: center;
margin-left: auto;
margin-right: auto;
color: #00c434;
border-style: dashed;
border-color: #00c434;
'>
    ROOM ALLOTED
      </div>
    </td>
    <td> <div style='margin-left:20px;'>
    Checkin : <br>
    Checkout : <br>
      Rooms: <br>
    </div>
    </td>
  </tr>
  
</table>

</div>

</html>