<?php
  /* Edit your database connnection settings here*/
  $hostname = 'localhost'; //database host
  $user = 'root'; //database username
  $pass = 'development'; //database password
  $db_name = 'cmu_tc'; //database name
  $connection = mysqli_connect($hostname,$user,$pass,$db_name) or die ("Could not connect to the database.");
?>
