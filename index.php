<?php
	session_start();
	include 'connect.php';
  /*$date_in = date("l, d.m.Y");
  $date_out = date('l, d.m.Y',strtotime(date('l, d.m.Y').' + 3 days'));
  $_SESSION['date_in'] = $date_in;
  $_SESSION['date_out'] = $date_out;*/
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
	<title>Methone Hotel</title>
</head>
<style>
  .image {
    width: 100%;
    height: 100vh;
    background: url("img/hotel2c.jpg");
		background-repeat: no-repeat;
		background-size: cover;
    background-attachment: fixed;
    background-position: top;
	}
</style>
<body>
  <div class="image"></div>
  <div class="nav">
    <a class="name" href="index.php">Methone Hotel</a>
    <a class="book" href="#">BOOK A ROOM</a>
    <a class="about" href="#">ABOUT US</a>
    <a class="about" href="#">CONTACT</a>
  </div>
  <div class="available">
    <form method="POST" action="book_room.php">
    <div class="in">
      <label for="">Check-In Date</label><br/>
      <input type="text" onfocus="(this.type = 'date')" name="date_in" autocomplete="off" min="2021-01-01" max="2026-12-31" value="<?php echo date('d.m.Y') ?>">
    </div>
    <div class="out">
      <label for="">Check-Out Date</label><br/>
      <input type="text" onfocus="(this.type = 'date')" name="date_out" autocomplete="off" min="2021-01-01" max="2026-12-31" value="<?php echo date('d.m.Y',strtotime(date('d.m.Y').' + 3 days')) ?>">
    </div>
    <div class="check">
      <input type="submit" value="CHECK AVAILABILITY" />
    </div>
  	</form>
	</div>
</body>
</html>
