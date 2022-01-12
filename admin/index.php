<?php
	session_start();
	include '../connect.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
	<link rel="stylesheet" href="style.css">
	<link rel="shortcut icon" type="image/jpg" href="../img/icon_admin.png"/>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Karla:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
	<title>Hotel Management System</title>
	<style>
	</style>
</head>
<body>
  <?php
  if(!isset($_SESSION['username'])) {
    header('Location: login.php');
  }
  ?>
	<section id="left-bar">
		<h2>Methone Hotel</h2>
		<h3>MANAGEMENT SYSTEM</h3>
		<a href="index.php">Home</a>
		<a href="booked.php">Booked</a>
		<a href="check_in.php">Check In</a>
		<a href="check_out.php">Check Out</a>
		<a href="rooms.php">Rooms</a>
		<a href="logout.php">Logout</a>
	</section>

	<?php
	if ($dbc) {
		$counter = 0;
		$query = "SELECT * FROM rooms WHERE status='0'";
		$result = mysqli_query($dbc,$query);
		if($result) {
			while($row = mysqli_fetch_assoc($result)) {
				$counter++;
			}
			echo "<p class='counter'>Number of available rooms: ".$counter."</p>";
		} else {
			echo "Error establishing a database connection!";
		}
	}

	?>
</body>
</html>
