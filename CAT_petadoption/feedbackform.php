<!-- these codes designed by ABASABEZA Honore Reg NO 222004595-->
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

//php codes to insert feedback into database

include('config.php');

if (isset($_POST['submit_feedback'])) {
    // Receive data from form
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    

    

    // save message into Database
   
    $stmt = $conn->prepare("INSERT INTO feedback ( name, email,message) 
    VALUES('$name','$email','$message')");
    $stmt->execute();
    $results = mysqli_query($conn, $stmt); // Pass $conn 
    if (mysqli_num_rows($results) == 1) {
        echo "feedback submitted";
        header('location: index.php');
    }
  
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Feedback Form</title>
</head>
<body style="background-image: url('background_image.jpg');">
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
                <a href="home.php">Home</a>
            </li>
            <li>
                <a href="home.php#report">Post an ad</a>
            </li>
            <li>
                <a href="lost.php">Lost animals</a>
            </li>
            <li>
                <a href="found.php">Animals found</a>
            </li>
            <li>
                <a href="adopt.php">Animals for adoption</a>
            </li>
            <li>
                <a href="feedbackform.php">feedback</a>
            </li>
            <li>
                <a href="profile.php">My profile</a>
            </li>
        </ul>
    </nav>
    <!-- Feedback Form -->
    <div id="banner">
        <h3>Feedback Form</h3>
        <form method="post" action="submit_feedback.php">
            <div class="input-group">
                <input type="text" name="name" required placeholder="Your Name">
            </div>
            <br>
            <div class="input-group">
                <input type="email" name="email" required placeholder="Your Email">
            </div>
            <br>
            <div class="input-group">
                <textarea name="message" required placeholder="Your Message"></textarea>
            </div>
            <br>
            <div class="input-group">
                <button type="submit" class="btn-readmore" name="submit_feedback">Submit</button>
            </div>
            <br>
            <a href="index.php" class="btn-readmore">Back</a>
        </form>
    </div>
    <!-- Footer -->
    <footer>
        <div id="left-footer">
            <p>
                <ul>
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="index.php#report">Post an ad</a>
                    </li>
                    <li>
                        <a href="lost.php">Lost animals</a>
                    </li>
                    <li>
                       <a href="found.php">Animals found</a>
                    </li>
                    <li>
                       <a href="adopt.php">Animals for adoption</a>
                    </li>
                    <li>
                        <a href="profile.php">My profile</a>
                    </li>
                        <a href="logout.php">Log Out</a>
                    </li>
                </ul>
            </p>
        </div>
        <div id="right-footer">
            <div id="social-media-footer">
                <ul>
                    <li>
                        <i>pet adoption</i>
                    </li>
                </ul>
            </div>
            <p>Pet adoption</p>
        </div>
    </footer>
</body>
</html>
