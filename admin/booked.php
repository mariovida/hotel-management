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
	<title>Booked - Management System</title>
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

	<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search by booking number...">

  <div class="container_booked">
    <ul class="responsive-table" id="myUL">
      <li class="table-header">
        <div class="space1">ID</div>
        <div class="space">Booking #</div>
        <div class="space">Room</div>
        <div class="space">Guest Name</div>
        <div class="space">Check-in Date</div>
        <div class="space">Check-out Date</div>
      </li>

      <?php
      if ($dbc) {
        $query = "SELECT id, ref, name, date_in, date_out, room FROM check_in";
        $result = mysqli_query($dbc,$query);

        if($result) {
          while($row = mysqli_fetch_array($result)) {
            echo "<li class='table-row'>
              <div class='space1'>".$row['id']."</div>
              <div class='space'>".$row['ref']."</div>
              <div class='space'>".$row['room']."</div>
              <div class='space'>".$row['name']."</div>
              <div class='space'>".$row['date_in']."</div>
              <div class='space'>".$row['date_out']."</div>
              </li>";
          }
        }
      }
      ?>
    </ul>
  </div>
	<script>
	function myFunction() {
	    var input, filter, ul, li, a, i, txtValue;
	    input = document.getElementById("myInput");
	    filter = input.value.toUpperCase();
	    ul = document.getElementById("myUL");
	    li = ul.getElementsByTagName("li");
	    for (i = 0; i < li.length; i++) {
	        a = li[i].getElementsByTagName("div")[1];
	        txtValue = a.textContent || a.innerText;
	        if (txtValue.toUpperCase().indexOf(filter) > -1) {
	            li[i].style.display = "";
	        } else {
	            li[i].style.display = "none";
	        }
	    }
	}
	</script>
</body>
</html>
