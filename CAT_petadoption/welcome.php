<!-- these codes designed by ABASABEZA Honore Reg NO 222004595-->

<?php //verify if logged in
session_start();
if (isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You're already logged in'";
    header('location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css stylesheet -->
    <link rel="stylesheet" href="style.css">
    <title>Welcome page</title>
</head>
<body>
    <!-- welcome to the site-->
    <div id="banner">
        <h1>Help a pet find a loving home</h1>
        <h3>Join a community of animal lovers to post or browse existing ads</h3>
        <a href="login.php" class="btn-readmore">Login</a>
        <a href="register.php" class="btn-readmore">Create account</a>
        <a href="index.php" class="btn-readmore">Back</a>
    </div>
</body>
</html>