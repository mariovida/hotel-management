<?php
	session_start();
	include 'connect.php';
	if(isset($_POST['date_in'])) {
		$date_in = $_POST['date_in'];
		$date_in = date("d.m.Y", strtotime($date_in));
	} else {
		$date_in = date('d.m.Y');
	}
	$timestamp = strtotime($date_in);
	$day_in = date('l', $timestamp);
	if(isset($_POST['date_out'])) {
		$date_out = $_POST['date_out'];
		$date_out = date("d.m.Y", strtotime($date_out));
	} else {
		$date_out = date('d.m.Y', strtotime(date('d.m.Y').' + 3 days'));
	}
	$timestamp = strtotime($date_out);
	$day_out = date('l', $timestamp);
  $calc_days = abs(strtotime($date_out) - strtotime($date_in));
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
	<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
	<title>Select Your Room</title>
</head>
<style>
  .image {
    width: 100%;
    height: 580px;
    background: url("img/hotel2c.jpg");
		background-repeat: no-repeat;
		background-size: cover;
    background-attachment: fixed;
    background-position: top;
	}
  .nav {
    position: absolute;
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

  <div class="back_wall"><h1 class="choose">CHOOSE A ROOM</h1></div>


  <div class="available_choose">
    <form method="POST" action="">
      <div class="in_choose">
        <label style="color:#FFC94D">Selected Check-In Date: </label><br/><br/>
        <b style="font-size:32px"><?php echo "".$day_in.", ".$date_in."."; ?></b>
      </div>
      <div class="out_choose">
        <label style="color:#FFC94D">Selected Check-Out Date: </label><br/><br/>
        <b style="font-size:32px"><?php echo "".$day_out.", ".$date_out."."; ?></b>
      </div>
    </form>
		<!--<h4 style="margin-top:50px;margin-bottom:30px" class="choose_button">We have different type of rooms for you</h4>-->
    <?php
			$query = "SELECT * FROM room_categories";
      $result = mysqli_query($dbc, $query);
        while($row = mysqli_fetch_array($result)) {
		?>

    <form class="room_card" method="POST" action="">
  		<img src="img/<?php echo $row['cover_img'] ?>" class="room">
  		<h3><b><?php echo $row['name'] ?></b></h3>
      <br/><br/><br/><br/><br/>
  		<h4><b><?php echo '$ '.number_format($row['price'],2) ?></b><span> / per day</span></h4>
		</form>
		<?php } ?>
  </div>

	<h4 class="choose_button">Choose a room</h4>
	<div class="choose_buttons">
  	<button class="click-button" id="myBtn1">Single Room</button>
  	<button class="click-button" id="myBtn2">Twin Room</button>
		<button class="click-button" id="myBtn3">Deluxe Room</button>
		<button class="click-button" id="myBtn4">Family Room</button>
		<button class="click-button" id="myBtn5">Suite Room</button>
	</div>

  <div id="myModal" class="modal">
    <div class="modal-content">
      <!--<span class="close">&times;</span>-->
      <h2>Almost done...</h2>

      <form method="POST" action="card.php">
        <div class="room_final">
          <br/><label for="name">Guest name</label><br/>
          <input type="text" name="name" class="input_field" required><br/><br/>
        </div>
        <div class="form-group">
          <label for="contact">Contact number</label><br/>
          <input type="text" name="contact" class="input_field" required><br/><br/>
        </div>
        <div class="form-group">
          <label for="date_in">Check-in date</label><br/>
          <input type="text" name="date_in" onfocus="(this.type = 'date')" class="input_field noclick" value="<?php echo "".$date_in."."; ?>" readonly><br/><br/>
        </div>
        <div class="form-group">
          <label for="date_out">Check-out date</label><br/>
					<input type="text" name="date_out" onfocus="(this.type = 'date')" class="input_field noclick" value="<?php echo "".$date_out."."; ?>" readonly><br/><br/>
        </div>
        <p>Days of Stay: <b><?php echo $calc_days ?></b></p>
        <input type="submit" class="submit" name="submit" value="Save">
				<button class="submit cancel" id="cancel">Cancel</button>
      </form>
    </div>
  </div>

	<footer>
		<p style="font-family: 'Dancing Script'">Methone Hotel</p>
	</footer>

  <script>
    var modal = document.getElementById("myModal");
    var btn1 = document.getElementById("myBtn1");
    var btn2 = document.getElementById("myBtn2");
		var btn3 = document.getElementById("myBtn3");
		var btn4 = document.getElementById("myBtn4");
		var btn5 = document.getElementById("myBtn5");
    var span = document.getElementsByClassName("cancel")[0];

    btn1.onclick = function() {
      modal.style.display = "block";
    }
    btn2.onclick = function() {
      modal.style.display = "block";
    }
		btn3.onclick = function() {
      modal.style.display = "block";
    }
    btn4.onclick = function() {
      modal.style.display = "block";
    }
		btn5.onclick = function() {
      modal.style.display = "block";
    }

    span.onclick = function() {
      modal.style.display = "none";
    }

    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }

		$(document).ready(function () {
			$('.click-button').on('click',function () {
				var button_id = $(this).attr('id');
				if(button_id == 'myBtn1') {
					createCookie("height", "1");
				} else if(button_id == 'myBtn2') {
					createCookie("height", "2");
				} else if(button_id == 'myBtn3') {
					createCookie("height", "3");
				} else if(button_id == 'myBtn4') {
					createCookie("height", "4");
				} else if(button_id == 'myBtn5') {
					createCookie("height", "5");
				}
      });
		});

		function createCookie(name, value) {
			document.cookie = name + "=" + value;
		}
  </script>
</body>
</html>
