<!-- these codes designed by ABASABEZA Honore Reg NO 222004595-->
<?php
$host = "localhost";
$user = "abao";
$password = "222004595";
$dbname = "petadoption";

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>
