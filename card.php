<?php
	session_start();
	include 'connect.php';
	$calc_days = abs(strtotime($_POST['date_out']) - strtotime($_POST['date_in']));
  $calc_days = floor($calc_days / (60*60*24)  );
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
	<link rel="stylesheet" href="style.css">
  <link rel="shortcut icon" type="image/jpg" href="img/icon_bell.png"/>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Karla:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
	<title>Hotel Managment System</title>
</head>
<style>
  body {
  	display: flex;
  	flex-flow: row nowrap;
  	align-items: center;
  	justify-content: center;
  	font-family: "Karla";
  }
</style>
<body>
  <div class="nav">
    <a class="name" href="index.php">Methone Hotel</a>
    <a class="book" href="#">BOOK A ROOM</a>
    <a class="about" href="#">ABOUT US</a>
    <a class="about" href="#">CONTACT</a>
  </div>

  <?php
    if (isset($_POST['submit'])) {
      $_SESSION['name'] = $_POST['name'];
      $_SESSION['contact'] = $_POST['contact'];
      $_SESSION['date_in'] = $_POST['date_in'];
      $_SESSION['date_out'] = $_POST['date_out'];
		  $room_cat = $_COOKIE["height"];
			if ($room_cat==1) {
				$price = 120;
			} else if ($room_cat==2) {
				$price = 200;
			} else if ($room_cat==3) {
				$price = 350;
			} else if ($room_cat==4) {
				$price = 400;
			} else if ($room_cat==5) {
				$price = 650;
			}
    } else {}
	?>

	<main id="main">
		<section id="left">
			<h1>Reservation summary</h1>
			<h3>Please check if everything is correct!</h3>
      <p><b>Name:</b> <?php echo $_POST['name'] ?></p>
      <p><b>Contact:</b> <?php echo $_POST['contact'] ?></p>
      <p><b>Check-in Date:</b> <?php echo $_POST['date_in'] ?></p>
      <p><b>Check-out Date:</b> <?php echo $_POST['date_out'] ?></p>
      <p><b>Room:</b> <?php if($room_cat==1) {echo "Single Room";} else if($room_cat==2) {echo "Twin Room";} else if($room_cat==3) {echo "Deluxe Room";} else if($room_cat==4) {echo "Family Room";} else if($room_cat==5){echo "Suite Room";} ?></p>
			<p><b>Price for Your Stay:</b> <?php echo '$'.number_format($price * $calc_days ,2) ?></p>
		</section>
		<section id="right">
			<form method="POST" action="book.php">
				<label for="cc-number">Card number:</label>
				<input type="number" name="cc-number" id="cc-number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="16" placeholder="1111 2222 3333 4444" required>

				<label for="expiry-month">Expiry date:</label>
				<div id="date-val">
					<select name="ex_month" id="expiry-month" required>
						<option id="trans-label_month" value="" default="default" selected="selected">Month</option>
						<option value="1">01</option>
						<option value="2">02</option>
						<option value="3">03</option>
						<option value="4">04</option>
						<option value="5">05</option>
						<option value="6">06</option>
						<option value="7">07</option>
						<option value="8">08</option>
						<option value="9">09</option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option>
					</select>
					<select name="ex_year" id="expiry-year" required>
						<option id="trans-label_year" value="" default="" selected="selected">Year</option>
						<option value="2021">2021</option>
						<option value="2022">2022</option>
						<option value="2023">2023</option>
						<option value="2024">2024</option>
						<option value="2025">2025</option>
						<option value="2026">2026</option>
						<option value="2027">2027</option>
						<option value="2028">2028</option>
						<option value="2029">2029</option>
					</select>
				</div>

        <label for="sec-code">Security code (CVV):</label>
        <input type="password" name="cvv" class="cvv" maxlength="3" placeholder="123" required>

        <input type="submit" name="submit" value="Make Your Reservation">
      </form>
    </section>
	</main>
</body>
</html>
