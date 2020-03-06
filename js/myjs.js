function toggle_collapse(op) {
    var ele = document.getElementById("collapse" + op);
    if (ele.classList.contains('show')) {
        ele.classList.remove('show');
    } else {
        ele.classList.add('show');
    }

}

function openCancelModal(op)
{
    document.getElementById('cancelModal').style.display = 'block';
    document.getElementById('cancel').action='cancel_booking.php?booking_id='+op;

}

function setDatetime(op) {
    var now = new Date();
    var day = ("0" + now.getDate()).slice(-2);
    var month = ("0" + (now.getMonth() + 1)).slice(-2);
    var today = now.getFullYear() + "-" + (month) + "-" + (day);
    document.getElementById(op+'date').value = today;
    var currentTime = ((now.getHours() < 10)?"0":"") + now.getHours() +":"+ ((now.getMinutes() < 10)?"0":"") + now.getMinutes();
    document.getElementById(op+'time').value = currentTime;
  }

function openCheckModal(op,id) {
    setDatetime(op);
    document.getElementById(op+'Modal').style.display = 'block';
    document.getElementById(op+'booking_id').value=id;
  }



function display_subdropdown() {

    var select = document.getElementById("rooms_dropdown");
    var select_sub = document.getElementById("rooms_subdropdown");
    for (var i = 0; i < select_sub.options.length;)
        select_sub.options[i] = null;

    if (select.options[select.selectedIndex].value == "type") {
        select_sub.options[0] = new Option('Deluxe', 'deluxe');
        select_sub.options[1] = new Option('Super Deluxe', 'super deluxe');
        select_sub.options[2] = new Option('VIP', 'vip');
    } else if (select.options[select.selectedIndex].value == "ac") {
        select_sub.options[0] = new Option('AC', 'ac');
        select_sub.options[1] = new Option('Non AC', 'nonac');

    } else if (select.options[select.selectedIndex].value == "capacity") {

        select_sub.options[0] = new Option('1', '1');
        select_sub.options[1] = new Option('2', '2');
        select_sub.options[2] = new Option('3', '3');

    }





}

function activateTab(current) {

    var all = document.getElementsByClassName("nav-link");
    for (var i = 0; i < all.length; ++i) {
        if (all[i].classList.contains('active'))
            all[i].classList.remove('active');
        if (all[i].id == current)
            all[i].classList.add("active");
    }


}

function validateForm(currentTab) {

    if (!currentTab) {
        var rooms = document.getElementsByName("roomsno")[0].value;

        var guests = document.getElementsByClassName("step").length - 1;

        if (guests / rooms > 2) 
        {
            document.getElementById('roomnumwarning').style.display = 'block';
            document.getElementById('roomnumwarning').innerHTML= 'Insufficient Rooms';
            return false;


        }
        else if ( guests / rooms < 1) {
            document.getElementById('roomnumwarning').style.display = 'block';
            document.getElementById('roomnumwarning').innerHTML= 'Excess Rooms';
            return false;

        }
      
    }
    var x, y, i, valid = true;
    x = document.getElementsByClassName("form-tab");
    y = x[currentTab].getElementsByTagName("input");
    // A loop that checks every input field in the current tab:


    for (i = 0; i < y.length; i++) {

        // If a field is empty...
        if (y[i].value == "") {
            if (!currentTab && document.getElementsByName('purpose')[0].value == "Personal" && y[i].id == 'purpose-desc')
                continue;
            // add an "invalid" class to the field:
            y[i].className += " invalid";
            // and set the current valid status to false
            valid = false;
        }
    }
    // If the valid status is true, mark the step as finished and valid:


    if (currentTab)
    {
        var tel=document.getElementsByName('contact[]')[currentTab-1];
     
        if(!tel.value.match(/^\d{10}$/))
        {
            valid=false;
            document.getElementsByName('contact[]')[currentTab-1].className+=" invalid";
        }
    }
    if (valid) {
        document.getElementsByClassName("step")[currentTab].className += " finish";
    }

    return valid;
    // return the valid status
}

function validateDates()

{
    var checkin = document.forms["book_form"]["checkin"].value;
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

    today = yyyy + '-' + mm + '-' + dd;

    if (checkin <= today) {
        //alert("Invalid checkin date");
        document.forms["book_form"]["checkin"].className+=' invalid';
        return false;
    }
    var checkout = document.forms["book_form"]["checkout"].value;
    if (checkout <= today) {
        //alert("Invalid checkout date");
        document.forms["book_form"]["checkout"].className+=' invalid';
        return false;
    }
    if (checkin >= checkout) {
        //alert("Enter valid dates");
        document.forms["book_form"]["checkout"].className+=' invalid';
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
    } else {
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

function confirmBook(n) {
    var details = "<table class='table '><tr class='borderless'><td><b>Number of rooms required: </b>" + document.getElementsByName('roomsno')[0].value + " </td><td><b>  Purpose: </b>" + document.getElementsByName('purpose')[0].value + " </td><td><b>   Payment Method: </b>" + document.getElementsByName('payment')[0].value + "</td></tr><tr><td  colspan=3 align='center'><b>GUESTS</b></td></tr>";

    var i;

    for (i = 0; i < n; ++i) { details = details + "<tr class='borderless'> " + "<td> " + document.getElementsByName("name[]")[i].value + "</td> " + "<td> " + document.getElementsByName("rel[]")[i].value + "</td> " + "<td> " + document.getElementsByName("contact[]")[i].value + "</td> " + "</tr> "; }
    document.getElementById("guests_info").innerHTML = details + "</table>";
    document.getElementById('confirm_modal').style.display = 'block';
}

function displayTable() {

    searchby = document.getElementById('searchby');
    searchby=searchby.options[searchby.selectedIndex].value;
    searchfor = document.getElementById('searchfor').value;
    filter = searchfor.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByClassName(searchby)[0];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}