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
	<title>Rooms - Management System</title>
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

  <div class="container_rooms">
    <ul class="responsive-table-rooms" id="myUL">
      <li class="table-header">
        <div class="space3">ID</div>
        <div class="space2">Category</div>
        <div class="space2">Room</div>
        <div class="space2">Status</div>
				<!--<div class="space2">Action</div>-->
      </li>

      <?php
      if ($dbc) {
        $query = "SELECT * FROM rooms";
        $result = mysqli_query($dbc,$query);

        if($result) {
          while($row = mysqli_fetch_array($result)) {
            echo "<li class='table-row'>
              <div class='space3'>".$row['id']."</div>
              <div class='space2'>";
							if($row['category_id']==1) {
								echo "Single room";
							} else if($row['category_id']==2) {
								echo "Twin room";
							} else if($row['category_id']==3) {
								echo "Deluxe room";
							} else if($row['category_id']==4) {
								echo "Family room";
							} else if($row['category_id']==5) {
								echo "Suite";
							}
							echo "</div>
              <div class='space2'>".$row['room']."</div>
              <div class='space2'>";
							if($row['status']==0) {
								echo "<p class='available_color'>Available</p>";
							} else if($row['status']==1) {
								echo "<p style='color:#FF554D;font-weight:600'>Unavailable</p>";
							}
							echo "</div>
              <!--<div class='space2'></div>-->
            </li>";
        	}
      	}
			}?>
    </ul>
  </div>
</body>
</html>
