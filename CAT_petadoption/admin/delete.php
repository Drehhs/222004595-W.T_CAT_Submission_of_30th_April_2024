<!-- these codes designed by ABASABEZA Honore Reg NO 222004595-->
<?php

//verification if user is logged in

session_start();
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../index.php');
    exit();
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
    exit();
}

// Check if the user is not an admin, redirect to regular index.php
if ($_SESSION['username'] !== 'admin') {
    header('location: ../index.php');
    exit();
}
<?php

//php codes to delete adoption information based on id

include 'config.php';
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$sql = "DELETE FROM adopt WHERE id = '$id'";
	
	$result = $conn->query($sql);
	
	if ($result ) {
		header('location:index.php');
	}else{
		echo "data not deleted";
	}
}

?>