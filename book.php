<?php
	session_start();
	include 'connect.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
	<link rel="stylesheet" href="style.css">
  <link rel="shortcut icon" type="image/jpg" href="img/icon_success.png"/>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Karla:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
	<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
	<title>Your Reservation is Confirmed</title>
</head>
<style>
.alert {
	display: absolute;
	margin: 0 auto;
	margin-top: 70px;
	width: 60%;
	border: 3px solid #FFC94D;
	border-radius: 16px;
}
h1, h2 {
	text-align: center;
	border: 0;
}
h1 {
	font-size: 64px;
	padding: 40px 0 30px 0;
	border-bottom: 3px solid #FFC94D;
	margin-bottom: 30px;
}
h2 {
	font-size: 26px;
}
h2:last-child {
	font-size: 19px;
	padding-top: 90px;
	padding-bottom: 40px;
}
.big {
	font-size: 32px;
	text-decoration: underline;
	padding-left: 10px;
}
a {
	color: black;
	text-decoration: underline;
}
</style>
<body>
	<?php
	if (isset($_POST['submit'])) {
		$name= $_SESSION["name"];
		$contact = $_SESSION["contact"];
		$dateIn = $_SESSION["date_in"];
		$dateOut = $_SESSION["date_out"];
		$room_cat = $_COOKIE["height"];
		$card_num = $_POST['cc-number'];
		$ex_month = $_POST['ex_month'];
		$ex_year = $_POST['ex_year'];
		$cvv = $_POST['cvv'];
		$ref = rand(123456789,999999999);
		$success = false;
		$norooms = false;

		$que = "SELECT id, room FROM rooms WHERE category_id = $room_cat AND status = '0' LIMIT 1";
		$result = mysqli_query($dbc, $que);
		while($row = mysqli_fetch_array($result)) {
			$room_id = $row['id'];
			$room = $row['room'];
			$query = "INSERT INTO check_in (ref, room_id, name, contact, date_in, date_out, room, card_num, ex_month, ex_year, cvv) VALUES ('$ref', '$room_id', '$name', '$contact', '$dateIn', '$dateOut', '$room', '$card_num', '$ex_month', '$ex_year', '$cvv')";
			$result2 = mysqli_query($dbc,$query) or die('Error querying database.');
			$query = "UPDATE rooms SET status = '1' WHERE id = $room_id";
			$update = mysqli_query($dbc,$query) or die('Error querying database.');
			$success = true;
			$norooms = true;
		}

		echo "<div class='alert'>";
		if($success==true) {
			echo "<h1>YOU ARE ALL SET!</h1>";
			echo "<h2>We got your reservation and we can't wait to see you soon.</h2>";
			echo "<h2>Your reservation number is: <span class='big'>" .$ref. "</span></h2>";
			echo "<h2>If you want to go back to our main page, <a href='index.php'>click here</a>.</h2>";
		} else if($norooms==false) {
			echo "<h1>WE ARE SO SORRY!</h1>";
			echo "<h2>We just found out we don't have any more of rooms available.</h2>";
			echo "<h2 style='font-size: 22px'>Please try a different type of room or contact us to resolve this problem.</h2>";
			echo "<h2>If you want to go back to our main page, <a href='index.php'>click here</a>.</h2>";
		} else {
			echo "<h1>Something went wrong!</h1>";
			echo "<h2>Please contact us by email or phone.</h2>";
		}
		echo "</div>";
	} else {
		header('Location: index.php');
	}
	?>
</body>
</html>
