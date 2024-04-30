<!-- these codes designed by ABASABEZA Honore Reg NO 222004595-->
<?php include('config.php') ?>
<?php // Check if the user is logged in
session_start();
if (!isset($_SESSION['username'])) {
	$_SESSION['msg'] = "You must log in first";
	header('location: welcome.php');
}
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['username']);
	header("location: welcome.php");
}


if (isset($_POST['report_adoption']) && isset($_FILES['image'])) {
  // Receive data from form
  $name = $_POST['name'];
  $species = $_POST['species'];
  $breed = $_POST['breed'];
  $gen = $_POST['gen'];
  $description = $_POST['description'];
  $city = $_POST['city'];
  $location = $_POST['location'];
  $contact = $_POST['contact'];

  // Form validation
  if (empty($name)) { 
    $name = "Unknown"; 
  } else if (empty($species)) { 
    array_push($errors, "Species must be selected"); 
  } else if (empty($gen)) { 
    array_push($errors, "Gender must be selected"); 
  }
  if (empty($breed)) { 
    $breed = "Unknown"; 
  } else if (empty($description)) { 
    array_push($errors, "Description must be provided"); 
  } else if (empty($city)) { 
    array_push($errors, "County must be provided"); 
  } else if (empty($location)) { 
    array_push($errors, "Address must be provided"); 
  } else if (empty($contact)) { 
    array_push($errors, "Contact information must be provided"); 
  }

  // Image upload to the database
  $img_name = $_FILES['image']['name'];
  $img_size = $_FILES['image']['size'];
  $tmp_name = $_FILES['image']['tmp_name'];
  $error = $_FILES['image']['error'];
  if ($error === 0) {
    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
    $img_ex_lc = strtolower($img_ex);
    $allowed_exs = array("jpg", "jpeg", "png");
    if (in_array($img_ex_lc, $allowed_exs)) {
      $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
      $img_upload_path = 'img/adopt/' . $new_img_name;
      move_uploaded_file($tmp_name, $img_upload_path);
      // Insert entry into the database
      if (count($errors) == 0) {
        $query = "INSERT INTO adopt 
                  VALUES('$name', '$species', '$breed', '$gen', '$description', '$city', '$location', '$new_img_name', '', '$contact')";
        mysqli_query($conn, $query);
        header('location: adopt.php');
      }
    }
  }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <!-- Stylesheets Used -->
    <link rel="stylesheet" href="style.css">
    <title>Post an Ad</title>
</head>
<body>
	<!-- Ad Posting Form -->
	<div id="banner">
		<h3 style="background: #99d1ce">Post an Animal for Adoption</h3>
		<form autocomplete="off" method="post" action="adoptreport.php" enctype="multipart/form-data">
			<?php include('errors.php'); ?>
			<div class="input-group">
				<label>Add an Image:</label>
				<input type="file" name="image" accept=".jpg, .jpeg, .png">
			</div>
			<br>
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
			<div class="input-group">
				<input type="text" placeholder="Address" name="location" value="<?php echo $location; ?>">
			</div>
			<br>
			<div class="input-group">
				<input type="text" placeholder="Contact Information" name="contact" value="<?php echo $contact; ?>">
			</div>
			<br>
			<div class="input-group">
				<button type="submit" class="btn-readmore" name="report_adoption">Post Ad</button>
			</div>
			<a href="index.php" class="btn-readmore">Back</a>
		</form>
	</div>
</body>
</html>
