

function validateForm(currentTab) {

   var x, y, i, valid = true;
  x = document.getElementsByClassName("form-tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:


  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:




  return valid;
    // return the valid status
}

function validateDates()

    {var checkin = document.forms["book_form"]["checkin"].value;
var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = today.getFullYear();

today = yyyy+'-'+mm+'-'+dd;

  if (checkin <= today) {
    alert("Invalid checkin date");
    return false;
  }
var checkout= document.forms["book_form"]["checkout"].value;
      if (checkout <= today) {
    alert("Invalid checkout date");
    return false;
  }
if(checkin>=checkout)
    {
        alert("Enter valid dates");
    return false;

    }
return true;
    }

// Display the current tab



function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("form-tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  }
    else
        {
           document.getElementById("nextBtn").innerHTML = "Next";
        }
  //... and run a function that will display the correct step indicator:
 fixStepIndicator(n);
}




function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}

function confirmBook(n)
{ var details="<table class='table'> ";

 var i;

 for( i=0; i<n; ++i)
     {details= details + "<tr> " + "<td> " + document.getElementsByName("name")[i].value + "</td> " +"<td> " + document.getElementsByName("rel")[i].value + "</td> " + "<td> " + document.getElementsByName("contact")[i].value + "</td> "  +"</tr> " ;}
 document.getElementById("guests_info").innerHTML=details + "</table>";
document.getElementById('confirm_modal').style.display='block';
}
