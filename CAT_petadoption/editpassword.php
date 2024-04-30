<!-- these codes designed by ABASABEZA Honore Reg NO 222004595-->
<?php include('editpw.php') ?>
<?php // Check if the user is logged in
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: welcome.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css -->
    <link rel="stylesheet" href="style.css">
    <title>Change Password</title>
</head>
<body>
    <!-- Change Password Form -->
    <div id="banner">
        <h3>Change Password</h3>
        <form method="post" action="editpassword.php">
        <?php include('errors.php'); ?>
            <div class="input-group">
                <input type="password" placeholder="Password" name="op">
            </div>
            <br>
            <div class="input-group">
                <input type="password" placeholder="New Password" name="np">
            </div>
            <br>
            <div class="input-group">
                <input type="password" placeholder="Confirm New Password" name="c_np">
            </div>
            <br>
            <div class="input-group">
                <button type="submit" class="btn-readmore" name="change_pw">Change Password</button>
            </div>
            <br>
            <a href="profile.php" class="btn-readmore">Back</a>
        </form>
    </div>
</body>
</html>
