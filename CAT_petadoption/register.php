<!-- these codes designed by ABASABEZA Honore Reg NO 222004595-->
<?php
session_start();
include('config.php'); // Include the database connection file

// REGISTER USER
if (isset($_POST['reg_user'])) {
    // Receive data from form
    $username = $_POST['username'];
    $name = $_POST['name'];
    $password_1 = $_POST['password_1'];
    $password_2 = $_POST['password_2'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];

    // Check if account exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? LIMIT 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        // Username already exists
        echo "username already exists";
        header('location: login.php'); // Redirect back to registration page
        exit();
    }

    // Registration
    $password = password_hash($password_1, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (username, name, password, email, phone, city) 
    VALUES('$username', '$name', '$password', '$email', '$phone', '$city')");
  
    $stmt->execute();
    $_SESSION['username'] = $username;
    $_SESSION['success'] = "You are now logged in";
    header('location: home.php');
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css stylesheet-->
    <link rel="stylesheet" href="style.css">
    <title>Registration</title>
</head>
<body>
    <!-- Registration Form -->
    <div id="banner">
        <h3>Create account</h3>
        <form method="post" action="register.php">
            
            <div class="input-group">
                <input type="text" name="username" required placeholder="username" value="<?php echo isset($username) ? $username : ''; ?>">
            </div>
            <br>
            <div class="input-group">
                <input type="text" name="name" required placeholder="Name" value="<?php echo isset($name) ? $name : ''; ?>">
            </div>
            <br>
            <div class="input-group">
                <input type="text" name="email" required placeholder="E-mail" value="<?php echo isset($email) ? $email : ''; ?>">
            </div>
            <br>
            <div class="input-group">
                <input type="text" name="phone" required placeholder="telephone number" value="<?php echo isset($phone) ? $phone : ''; ?>">
            </div>
            <br>
            <div class="input-group">
                <input type="text" name="city" required placeholder="City" value="<?php echo isset($city) ? $city : ''; ?>">
            </div>
            <br>
            <div class="input-group">
                <input type="password" required placeholder="Password" name="password_1">
            </div>
            <br>
            <div class="input-group">
                <input type="password" required placeholder="Confirm Password" name="password_2">
            </div>
            <br>
            <div class="input-group">
                <button type="submit" class="btn-readmore" name="reg_user">Register</button>
            </div>
            <br>
            <a href="login.php" class="btn-readmore">already have an account?</a>
            <a href="welcome.php" class="btn-readmore">Back</a>
        </form>
    </div>
</body>
</html>
