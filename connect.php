<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $basename = "hotel";

  $dbc = mysqli_connect($servername, $username, $password, $basename) or
  die('Error connecting to MySQL server.'.mysqli_connect_error());
  mysqli_set_charset($dbc, "utf8");
?>
