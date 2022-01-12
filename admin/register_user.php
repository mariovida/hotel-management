<?php
	session_start();
	include '../connect.php';
?>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
	<link rel="stylesheet" href="style.css">
	<link rel="shortcut icon" type="image/jpg" href=""/>
	<link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Karla:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
	<title>Register - Hotel Managment System</title>
	<style>
		body {
			font-family: 'Karla';
		}
		form {
			width: 40%;
			margin-left: 30%;
			margin-top: 10px;
      margin-bottom: 20px;
			padding: 20px 0;
			border: 2px solid black;
      border-radius: 7px;
		}
		input {
			width: 50%;
			height: 30px;
			padding: 16px 0 16px 10px;
			margin-left: 25%;
			box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
			border: 1px solid #D9D9D9;
			border-radius: 4px;
		}
		.showpass {
			width: 13px;
			height: 13px;
			margin-top: 12px;
			margin-right: 7px;
		}
		.bojaPoruke {
			position: relative;
			width: 40%;
			left: 36%;
			text-align: center;
			color: red;
		}
		.prijava {
			font-size: 17px;
			height: auto;
			padding: 10px 0;
			transition: 0.25s;
			cursor: pointer;
			border: 2px solid #f29040;
			background-color: #F4A261;
		}
		.prijava:hover {
			background-color: #f29040;
			color: white;
		}
		h1 {
			text-align: center;
			padding: 0;
			margin-top: 30px;
			padding-bottom: 20px;
		}
		p {
			position: relative;
			text-align: center;
			margin-top: 20px;
			font-size: 24px;
		}
	</style>
</head>
<body>
	<h1>REGISTER NEW USER</h1>
  <form method="POST" action="" name="reg">
    <input name="name" id="name" type="text" class="name" placeholder="Ime" required/>
		<br/><br/>

    <input name="username" id="username" type="text" class="username" placeholder="Korisničko ime" required/>
		<br/><br/>

    <input name="pass" id="lozinka" type="password" class="pass" placeholder="Lozinka" required/>
		<br/><input type="checkbox" class="showpass" onclick="myFunction1()">Prikaži lozinku
    <br/><br/>

		<input name="pass" id="lozinkaRep" type="password" class="pass pass_mes" placeholder="Lozinka" required/>
		<br/><input type="checkbox" class="showpass" onclick="myFunction2()">Prikaži lozinku
		<br/><span id="porukaPass" class="bojaPoruke"></span>
    <br/>

    <input name="submit" type="submit" class="prijava" id="prijava" value="Registracija" />
  </form>

  <?php

    if ($dbc && isset($_POST['submit'])) {
      $id = rand(11111,99999);
      $username = $_POST['username'];
      $password = $_POST['pass'];
      $hashed_password = password_hash($password, CRYPT_BLOWFISH);
      $name = $_POST['name'];
      $register = false;

      $sql = "SELECT * FROM users WHERE username = ?";
      $stmt = mysqli_stmt_init($dbc);
      if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, 's', $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
      }
			if (mysqli_stmt_num_rows($stmt) > 0) {
        echo "<p style='color:#EA212D;font-weight:bold;padding-bottom:10px'>Korisničko ime već postoji!</p>";
      } else {
        $sql = "INSERT INTO users (id, name, username, password) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($dbc);
        if (mysqli_stmt_prepare($stmt, $sql)) {
          mysqli_stmt_bind_param($stmt, 'dsss', $id, $name, $username, $hashed_password);
          mysqli_stmt_execute($stmt);
          $register = true;
        }
      }

      if($register == true) {
        echo '<p style="padding-bottom: 10px">Korisnik je uspješno registriran!</p>';
				header("refresh:5;url=login.php");
      }
    }

    mysqli_close($dbc);
  ?>
  <script src="reg.js"></script>
</body>
</html>
