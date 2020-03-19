<?php

include 'header.php';
require_once 'config.php';


if (isset($_SESSION['userData'])) {
	header('location: user.php');
}

$loginURL = "";
$authUrl = $googleClient->createAuthUrl();
$loginURL = filter_var($authUrl, FILTER_SANITIZE_URL);

if (isset($_POST['func']) && !empty($_POST['func'])) {
	switch ($_POST['func']) {
		case 'getCalender':
			getCalender($_POST['year'], $_POST['month']);
			break;
		case 'getEvents':
			getEvents($_POST['date']);
			break;
		default:
			break;
	}
}


/*
 * Get calendar full HTML
 */
function getCalender($year = '', $month = '')
{
	$dateYear = ($year != '') ? $year : date("Y");
	$dateMonth = ($month != '') ? $month : date("m");
	$date = $dateYear . '-' . $dateMonth . '-01';
	$currentMonthFirstDay = date("N", strtotime($date));
	$totalDaysOfMonth = cal_days_in_month(CAL_GREGORIAN, $dateMonth, $dateYear);
	$totalDaysOfMonthDisplay = ($currentMonthFirstDay == 7) ? ($totalDaysOfMonth) : ($totalDaysOfMonth + $currentMonthFirstDay);
	$boxDisplay = ($totalDaysOfMonthDisplay <= 35) ? 35 : 42;
?>
	<div id="calender_section">
		<h2>
			<a href="javascript:void(0);" onclick="getCalendar('calendar_div','<?php echo date("Y", strtotime($date . ' - 1 Month')); ?>','<?php echo date("m", strtotime($date . ' - 1 Month')); ?>');">&#8249</a>
			<select name="month_dropdown" class="month_dropdown dropdown_calendar"><?php echo getAllMonths($dateMonth); ?></select>
			<select name="year_dropdown" class="year_dropdown dropdown_calendar"><?php echo getYearList($dateYear); ?></select>
			<a href="javascript:void(0);" onclick="getCalendar('calendar_div','<?php echo date("Y", strtotime($date . ' + 1 Month')); ?>','<?php echo date("m", strtotime($date . ' + 1 Month')); ?>');">&#8250</a>
		</h2>

		<div id="calender_section_top">
			<ul>
				<li>Sun</li>
				<li>Mon</li>
				<li>Tue</li>
				<li>Wed</li>
				<li>Thu</li>
				<li>Fri</li>
				<li>Sat</li>
			</ul>
		</div>
		<div id="calender_section_bot">
			<ul>
				<?php
				$dayCount = 1;
				for ($cb = 1; $cb <= $boxDisplay; $cb++) {
					if (($cb >= $currentMonthFirstDay + 1 || $currentMonthFirstDay == 7) && $cb <= ($totalDaysOfMonthDisplay)) {
						//Current date
						$currentDate = $dateYear . '-' . $dateMonth . '-' . $dayCount;

						//Include db configuration file
						include 'dbConfig.php';
						//Get number of events based on the current date
						$total = $db->query("SELECT *  FROM rooms")->num_rows;

						$booked = $db->query("SELECT DISTINCT room_id FROM guests WHERE room_id>0 AND expected_checkin <='" . $currentDate . "' AND expected_checkout >='" . $currentDate . "'")->num_rows;
						$free = $total - $booked;
						$percent = ($booked / $total) * 100;
						global $loginURL;
						//Define date cell color

						if (strtotime($currentDate) < strtotime(date("Y-m-d"))) {
							echo '<li date="' . $currentDate . '" class="date_cell">';
						} elseif (strtotime($currentDate) == strtotime(date("Y-m-d"))) {
							echo '<li date="' . $currentDate . '" class="current date_cell"  >';
						} else {
							echo "<a style='text-decoration:none;color:black;' href='";
							echo htmlspecialchars($loginURL);
							echo "'>";

							if ($percent >= 80) {
								echo '<li date="' . $currentDate . '" class="red date_cell">';
							} elseif ($percent >= 40) {
								echo '<li date="' . $currentDate . '" class="yellow date_cell">';
							} else {
								echo '<li date="' . $currentDate . '" class="green date_cell">';
							}
						}

						//Date cell
						echo '<span>';
						echo $dayCount;
						echo '</span>';

						//Hover event popup
						echo  '<div id="date_popup_' . $currentDate . '" class="date_popup_wrap none">';
						echo '<div class="date_window">';
						echo (strtotime($currentDate) > strtotime(date("Y-m-d"))) ? '<div class="popup_event">Rooms Available:' . $free . ' </div>' : '';


						echo '</li>';
						if (strtotime($currentDate) > strtotime(date("Y-m-d"))) {
							echo "</a>";
						}

						$dayCount++;
				?>
					<?php } else { ?>
						<li><span>&nbsp;</span></li>
				<?php }
				}

				?>

			</ul>
		</div>
	</div>


	<script type="text/javascript">
		function getNextday(date) {
			var tomorrow = new Date(date);
			tomorrow.setDate(tomorrow.getDate() + 1);
			return tomorrow.toJSON().slice(0, 10);
		}

		function getCalendar(target_div, year, month) {
			$.ajax({
				type: 'POST',
				url: 'functions.php',
				data: 'func=getCalender&year=' + year + '&month=' + month,
				success: function(html) {
					$('#' + target_div).html(html);
				}
			});
		}




		$(document).ready(function() {
			$('.date_cell').mouseenter(function() {
				date = $(this).attr('date');
				$(".date_popup_wrap").fadeOut();
				$("#date_popup_" + date).fadeIn();
			});
			$('.date_cell').mouseleave(function() {
				$(".date_popup_wrap").fadeOut();
			});
			$('.month_dropdown').on('change', function() {
				getCalendar('calendar_div', $('.year_dropdown').val(), $('.month_dropdown').val());
			});
			$('.year_dropdown').on('change', function() {
				getCalendar('calendar_div', $('.year_dropdown').val(), $('.month_dropdown').val());
			});
			$(document).click(function() {
				$('#event_list').slideUp('slow');
			});
		});
	</script>
<?php
}

/*
 * Get months options list.
 */
function getAllMonths($selected = '')
{
	$options = '';
	for ($i = 1; $i <= 12; $i++) {
		$value = ($i < 10) ? '0' . $i : $i;
		$selectedOpt = ($value == $selected) ? 'selected' : '';
		$options .= '<option value="' . $value . '" ' . $selectedOpt . ' >' . date("F", mktime(0, 0, 0, $i + 1, 0, 0)) . '</option>';
	}
	return $options;
}

/*
 * Get years options list.
 */
function getYearList($selected = '')
{
	$options = '';
	for ($i = date('Y'); $i <= date('Y') + 10; $i++) {
		$selectedOpt = ($i == $selected) ? 'selected' : '';
		$options .= '<option value="' . $i . '" ' . $selectedOpt . ' >' . $i . '</option>';
	}
	return $options;
}



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
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<title>NITC GH</title>
</head>

<body>
	<?php echo display_header(); ?>
	<div id="main">
		<div class="container-fluid">

			<div class="row justify-content-center">
				<div class="col">
					<div id="caraousel" class="carousel slide" data-ride="carousel">

						<!-- Indicators -->
						<ul class="carousel-indicators">
							<li data-target="#caraousel" data-slide-to="0" class="active"></li>
							<li data-target="#caraousel" data-slide-to="1"></li>
							<li data-target="#caraousel" data-slide-to="2"></li>
						</ul>

						<!-- The slideshow -->
						<div class="carousel-inner">
							<div class="carousel-item active">
								<img src="images\nitc1.jpeg" class="carouselImg" alt="Picture Unavailable">
							</div>
							<div class="carousel-item">
								<img src="images\nitc2.jpeg" class="carouselImg" alt="Picture Unavailable">
							</div>
							<div class="carousel-item">
								<img src="images\nitc3.jpeg" class="carouselImg" alt="Picture Unavailable">
							</div>
						</div>

						<!-- Left and right controls -->
						<a class="carousel-control-prev" href="#caraousel" data-slide="prev">
							<span class="carousel-control-prev-icon"></span>
						</a>
						<a class="carousel-control-next" href="#caraousel" data-slide="next">
							<span class="carousel-control-next-icon"></span>
						</a>

					</div>
				</div>
			</div> <br>

			<div class="row justify-content-center">
				<a class="homeBtn" href="#showavailability">
					<span>CHECK AVAILABILITY</span>
				</a>
			</div> <br>

			<div id="showavailability">

				<?php
				if (isset($_SESSION['wrongemail'])) {

					session_destroy();
					echo "<div class='row justify-content-center'><div class='alert alert-danger' role='alert'>
       Please login using <b> NIT-C email id</b>
      </div></div>";
				}
				?>

				<div class="row justify-content-center">
					<div id="calendar_div" class="col">
						<?php echo getCalender(); ?>
					</div>
				</div>
			</div> <br>



			<div class=" row justify-content-center">
				<a class="homeBtn" href="<?= htmlspecialchars($loginURL); ?>">
					<span>BOOK NOW</span>
				</a>
			</div>
		</div>

</body>

</html>