<!-- these codes designed by ABASABEZA Honore Reg NO 222004595-->
<?php //verify if user logged in
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css-->
  <link rel="stylesheet" href="style.css">
    <title>Menu Profile </title>
</head>
<body>
    <!-- navigation menu -->
    <div id="slideout-menu">
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
    </div>
    <!-- navigation bar -->
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
                <a href="feedbackform.php">feedback</a>
            </li>
            <li>
                <a href="profile.php">My profile</a>
            </li>
        
            <li>
                <div id="search-icon">
                </div>
            </li>
        </ul>
    </nav>
    <main>
        <h2 class="page-heading">Profilul meu</h2>
        <div id="post-container">
            <!-- profile section-->
            <section id="profile-desc">
                <?php
                // DB connect
                include('config.php');
                // Query 
                $sql = "SELECT * FROM users WHERE username = '" . $_SESSION['username'] . "'";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result)) {
                    // Display of login details
                    echo '<div class="card">';
                    echo "<table>";
                    echo "<tr>";
                    echo "<td> Username: " . $row['username'] . "</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td> FullName : " . $row['name'] . "</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td> E-mail: " . $row['email'] . "</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td> Telefone: " . $row['phone'] . "</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td> City: " . $row['city'] . "</td>";
                    echo "</tr>";
                    echo "</table>";
                }
                ?>
            </section>
            <!--  Profile settings-->
            <section id="sidebar">
                <h3>settings</h3>
                <a href="editpassword.php" class="btn-readmore-s">Change password</a>
                <a href="logout.php" class="btn-readmore-s">Log Out</a>
            </section>
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
                       <a href="feedbackform.php">feedback</a>
                    </li>
                    <li>
                        <a href="profile.php">My profile</a>
                    </li>
                        <a href="logout.php">Log Out</a>
                    </li>
                </ul>
                </p>
            </div>
            
        </footer>
    </main>
    <script src="main.js"></script>
</body>
</html>