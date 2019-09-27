<?php

function display_rooms()
{

?>
<div class= "row">

        <div class="col-sm-4">
        <select class="form-control" id="rooms_dropdown" name="rooms_dropdown" onchange="display_subdropdown()" >
    <option value="all" > All Rooms</option>
    <option value="ac"> AC</option>
    <option value="type"> Room Type </option>
    <option value="capacity"> Capacity</option>
</select></div>

<div class="col-sm-4">
    <select  class="form-control" id="rooms_subdropdown" name="rooms_subdropdown">

</select>
    </div>
    <div class="col-sm-2"> <button onclick="generate_query" class="btn btn-primary">Go</button></div>



</div>


<div class="row" id="table"></div>

<?php
}

function display_table($sql)
{
 echo $sql;
}

?>


<script>
function display_subdropdown()
    {

        var select = document.getElementById("rooms_dropdown");
        var select_sub=document.getElementById("rooms_subdropdown");
        for ( var i = 0; i < select_sub.options.length;)
                    select_sub.options[i] = null;

        if (select.options[select.selectedIndex].value=="type")
            {
                select_sub.options[0] = new Option('Deluxe', 'Deluxe');
                select_sub.options[1] = new Option('Super Deluxe', 'Super Deluxe');
                 select_sub.options[2] = new Option('VIP', 'VIP');
            }
           else  if (select.options[select.selectedIndex].value=="ac")
            {
                select_sub.options[0] = new Option('AC', 'AC');
                select_sub.options[1] = new Option('Non AC', 'Non AC');

            }
        else if
            (select.options[select.selectedIndex].value=="capacity")
            {

                select_sub.options[0] = new Option('1','1');
                select_sub.options[1] = new Option('2','2');
                select_sub.options[2] = new Option('3','3');

            }





    }

function generate_query()
    {
        var select = document.getElementById('rooms_dropdown');
        var col=select.options[select.selectedIndex].value;
        var select_sub=document.getElementById('rooms_subdropdown');
        var val = select.options[select.selectedIndex].value;
        var sql;
        if(col=="all")
            sql ="SELECT * FROM rooms";
        else
            sql="SELECT * FROM rooms WHERE "+col+"="+val;
        document.getElementById('table')="<?php echo display_table(sql)?>";

    }
    /*
    <?php
    include('dbConfig.php');
    if (isset($_POST['rooms_subdropdown']))
        $sql= "SELECT * FROM rooms WHERE ".$_POST['rooms_dropdown']."=".$_POST['rooms_subdropdown'];
    else
        $sql="SELECT * FROM rooms";
    $result = mysqli_query($db,$sql);
    echo "<table align='center' class='table table-hover'>";
echo "<tr><th>Sl</th><th>LOCATION</th><th>ROOM NUM</th><th>AC</th><th>TYPE</th><th>RENT</th><th>CAPACITY</th></tr>";
    while($rr=mysqli_fetch_array($result))
		{
		echo "<tr><td>";

		echo $rr['room_id'];
			echo "</td><td>";
		echo $rr['location'];
        echo "</td><td>";
		echo $rr['room_num'];
        echo "</td><td>";
		echo $rr['ac'];
        echo "</td><td>";
		echo $rr['type'];
        echo "</td><td>";
		echo $rr['rent'];
        echo "</td><td>";
		echo $rr['capacity'];
		echo "</td></tr>";
		}
		echo "</table>";

    ?>
    */
</script>
