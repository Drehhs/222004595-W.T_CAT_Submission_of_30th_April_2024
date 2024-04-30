<!-- these codes designed by ABASABEZA Honore Reg NO 222004595-->
<?php
session_start();
$errors = array();
// Connect to the database
include('config.php');
if (isset($_SESSION['username'])) {
  // CHANGE PW
  if (isset($_POST['change_pw'])) {
    // Receive data from the form
    $op = mysqli_real_escape_string($db, $_POST['op']);
    $np = mysqli_real_escape_string($db, $_POST['np']);
    $c_np = mysqli_real_escape_string($db, $_POST['c_np']);
    $username = $_SESSION['username'];
    // Form validation
    if (empty($op)) { array_push($errors, "Old password is required"); }
    else if (empty($np)) { array_push($errors, "New password is required"); }
    else if (empty($c_np)) { array_push($errors, "Confirm new password is required"); }
    else if ($np != $c_np ) {
      array_push($errors, "The two passwords do not match");
    }
    // Change the password in the database with the new one entered
    if (count($errors) == 0) {
      $op = md5($op);
      $np = md5($np);
      $username = $_SESSION['username'];
      $sql = "SELECT password
                FROM users WHERE 
                username='$username' AND password='$op'";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) === 1) {
        $sql_2 = "UPDATE users
        	        SET password='$np'
        	        WHERE username='$username'";
        mysqli_query($conn, $sql_2);
        header("Location: profile.php");
      }
    }
  }
}
?>
