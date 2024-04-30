<?php
session_start();
// LOGOUT 
session_destroy();
  	unset($_SESSION['username']);
  	header("location: welcome.php");
?>