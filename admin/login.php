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
  <link rel="shortcut icon" type="image/jpg" href="./img/lock.png"/>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Karla:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
	<title>Admin - Hotel Management System</title>
</head>
<style>
  body {
    width: 98%;
    height: 100%;
		background-color: #D1BDA8;
    font-family: 'Karla';
	}
	h1 {
		text-align: center;
		font-family: 'Dancing Script';
		font-size: 86px;
		margin-top: 30px;
		color: #454B54;
	}
	h2 {
		text-align: center;
		font-size: 22px;
		letter-spacing: 1px;
		margin-top: 5px;
		color: #454B54;
	}
	.login_form {
    width: 32%;
    height: 300px;
    margin-top: 30px;
    margin-left: 34%;
    border: 3px solid #52605F;
		border-radius: 5px;
    text-align: center;
    font-size: 17px;
  }
  .label {
    position: relative;
    top: 55px;
  }
  .login_form input {
    width: 210px;
    height: 25px;
    margin-top: 6px;
		padding: 3px 0;
    font-size: 16px;
    text-align: center;
    border: 2px solid #52605F;
    border-radius: 8px;
		background-color: #EEEEEE;
  }
  .login_form input:focus {
    outline: none;
  }
  input.login {
    width: 140px;
    height: auto;
    font-size: 17px;
    margin-top: 30px;
    padding: 6px 0;
    background-color: transparent;
    border: 2px solid #52605F;
    border-radius: 8px;
    cursor: pointer;
		transition: 0.1s;
  }
  input.login:hover {
    background-color: #52605F;
		color: #EEEEEE;
  }
</style>
<body>
	<h1>Methone Hotel</h1>
	<h2>MANAGEMENT SYSTEM</h2>
  <form method="POST" class="login_form" action="">
    <div class="label">
      <label for="username" class="control_label">Username</label><br/>
      <input type="text" id="username" name="username" class="form-control"><br/><br/>
    </div>
    <div class="label">
      <label for="password" class="control_label">Password</label><br/>
      <input type="password" id="password" name="password" class="form-control"><br/>
    </div>

    <div class="label"><input type="submit" name="login" class="login" id="login" value="LOGIN" /></div>

    <?php
      if (isset($_POST['login'])) {
    	 	$user = $_POST['username'];
    	 	$pass = $_POST['password'];
    	 	$sql = "SELECT username, password FROM users WHERE username = ?";
        $stmt = mysqli_stmt_init($dbc);
    	 		if (mysqli_stmt_prepare($stmt, $sql)) {
    	 			mysqli_stmt_bind_param($stmt, 's', $user);
    	 			mysqli_stmt_execute($stmt);
    	 			mysqli_stmt_store_result($stmt);
    	 		}
    	 		mysqli_stmt_bind_result($stmt, $userName, $userPass);
    	 		mysqli_stmt_fetch($stmt);

          if (password_verify($_POST['password'], $userPass) && mysqli_stmt_num_rows($stmt) > 0) {
            $login_success = true;
    	 		  $_SESSION['username'] = $userName;
            header('Location: index.php');
    	 	  } else {
    	 		  $login_success = false;
    	 	}
    	}
    ?>
  </form>
</body>
</html>
