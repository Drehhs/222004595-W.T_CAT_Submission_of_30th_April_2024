<!-- these codes designed by ABASABEZA Honore Reg NO 222004595-->
<?php
session_start();
// LOGOUT 
session_destroy();
  	unset($_SESSION['username']);
  	header("location: ../index.php");
?>