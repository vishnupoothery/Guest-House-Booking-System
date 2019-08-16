function validateForm() {
  var checkin = document.forms["form"]["checkin"].value;
var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = today.getFullYear();

today = yyyy+'-'+mm+'-'+dd;

  if (checkin <= today) {
    alert("Invalid checkin date");
    return false;
  }
var checkout= document.forms["form"]["checkout"].value;
      if (checkout <= today) {
    alert("Invalid checkout date");
    return false;
  }
if(checkin>=checkout)
    {
        alert("Enter valid dates");
    return false;

    }
var num=document.forms["form"]["num"].value;
    if(num<1)
        {
           alert("Specify number of guests");
    return false;

        }
}


function update(ele){


    var date=ele.getAttribute("date",0);
    //alert(date);
    this.style.background="#b3f0ff";
    document.getElementById("checkin").value=date;

} //change here
