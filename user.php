<?php
  session_start();
  if(!empty($_SESSION) && isset($_SESSION['my_uid'])) {
    header('Location: home.php');
  
?>
