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

<?php
include 'config.php';
$id = $_GET['id'];
$sql = "SELECT * FROM adopt  WHERE id = '$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
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
    <div id="banner">
        <h1>Adoption information</h1>


        <!--update form-->

        <div id="banner">
		<h3 style="background: #99d1ce">update Animal for Adoption</h3>
		<form autocomplete="off" method="post" action="update.php" enctype="multipart/form-data">
			
			
			<div class="input-group">
				<input type="text" placeholder="Name" name="name" value="<?php echo $name; ?>">
			</div>
			<br>
			<div class="radio-group">
				<label>Species:</label>
				<label for="Dog">
					<input id="Dog" value="Dog" name="species" type="radio"> Dog
				</label>
				<label for="Cat">
					<input id="Cat" value="Cat" name="species" type="radio"> Cat
				</label>
			</div>
			<br>
			<div class="radio-group">
				<label>Gender:</label>
				<label for="Female">
					<input id="Female" value="Female" name="gen" type="radio"> Female
				</label>
				<label for="Male">
					<input id="Male" value="Male" name="gen" type="radio"> Male
				</label>
			</div>
			<br>
			<div class="input-group">
				<input type="text" placeholder="Breed" name="breed" value="<?php echo $breed; ?>">
			</div>
			<br>
			<div class="input-group">
				<input type="text" placeholder="Description" name="description" value="<?php echo $description; ?>">
			</div>
			<br>
			<div class="input-group">
				<input type="text" placeholder="County" name="city" value="<?php echo $city; ?>">
			</div>
			<br>
			
			<br>
			<div class="input-group">
				<input type="text" placeholder="Contact Information" name="contact" value="<?php echo $contact; ?>">
			</div>
			<br>
			<div class="input-group">
				<button type="submit" class="btn-readmore" name="update">Update</button>
			</div>
			<a href="index.php" class="btn-readmore">Back</a>
		</form>
	</div>
        


    </div>
</body>
</html>

<?php
// php codes to update adoption information
if (isset($_POST['update'])) {
include 'config.php';
$id = $_GET['furnitureid'];
$name = $_POST['name'];
$species = $_POST['species'];
$gen = $_POST['gen'];
$breed = $_POST['breed'];
$city = $_POST['city'];
$contact = $_POST['contact'];

$sql = "UPDATE adopt SET name='$name',species = '$species',breed = '$breed',gen = '$gen',city = '$city',contact = '$contact' WHERE id = '$id'";

$result = $conn->query($sql);

if ($result) {
	header('location:index.php');
}else{
	echo "error in update ";
}
}
 ?>
