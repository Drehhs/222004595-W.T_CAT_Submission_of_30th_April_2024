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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Admin Dashboard</title>
</head>
<body>
    <!-- Admin Dashboard Content -->
    <h1>Welcome, Admin!</h1>
    
    
    <nav>
        <div id="logo-img">
            <a href="index.php">
                <img src="img/logo.png">
            </a>
        </div>
        <div id="menu-icon">
            <i class="fas fa-bars"></i>
        </div>
        <ul>
            <li>
                <a href="index.php">Home</a>
            </li>
            <li>
                <a href="logout.php">logout</a>
            </li>
           
        </ul>
    </nav>
    
    <!-- display  -->
    <div id="banneradmin">
        <h1>Adoption information</h1>
        

        <?php
        include 'config.php';
        $sql = "SELECT * FROM adopt";
        $result = $conn->query($sql);
        echo '<table border="1">
		<tr><td>id</td><td>name</td><td>species</td><td>breed</td><td>gen</td><td>description</td><td>city</td><td>contact</td></tr>';
        if ($result->num_rows >0) {
	    while ($row = $result->fetch_assoc()) {
		echo'
		<tr>';
		$id = $row['id'];
		echo '<td>'.$row['id'].'</td>';
		echo'<td>'.$row['name'].'</td>';
		echo'<td>'.$row['species'].'</td>';
        echo'<td>'.$row['breed'].'</td>';
        echo'<td>'.$row['gen'].'</td>';
        echo'<td>'.$row['description'].'</td>';
        echo'<td>'.$row['city'].'</td>';
        echo'<td>'.$row['contact'].'</td>';

		echo"<td><a href=delete.php?id=$row[id]>delete</td>";
		echo"<td><a href=update.php?id=$id>update</td>";
		
		
		echo'</tr>';
	
	         }
        }else{
            echo "error in retrieve";
        }
        echo "</table>";
        ?>

    </div>
</body>
</html>
