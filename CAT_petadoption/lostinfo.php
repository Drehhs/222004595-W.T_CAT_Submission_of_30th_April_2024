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
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="style.css">
    <title>Lost Animals</title>
</head>
<body>
    <!-- Navigation menu -->
    <div id="slideout-menu">
        <ul>
            <li>
                <a href="home.php">Home</a>
            </li>
            <li>
                <a href="home.php#report">Post an Announcement</a>
            </li>
            <li>
                <a href="lost.php">Lost Animals</a>
            </li>
            <li>
                <a href="found.php">Found Animals</a>
            </li>
            <li>
                <a href="adopt.php">Animals for Adoption</a>
            </li>
            <li>
                <a href="profile.php">My Profile</a>
            </li>
        </ul>
    </div>
    <!-- Navigation bar -->
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
                <a href="#report">Post an Announcement</a>
            </li>
            <li>
                <a href="lost.php">Lost Animals</a>
            </li>
            <li>
                <a href="found.php">Found Animals</a>
            </li>
            <li>
                <a href="adopt.php">Animals for Adoption</a>
            </li>
            <li>
                <a href="profile.php">My Profile</a>
            </li>
        </ul>
    </nav>
    <main>
        <!-- Display animal card -->
        <br><br><br><br>
        <?php
        // URL parameter id of the animal
        $id = $_GET['id'];
        // Connect to the database
        include('config.php');
        // Query the database based on the id
        $count = "SELECT * FROM lost where id=?";
        if ($stmt = $conn->prepare($count)) {
            $stmt->bind_param('i', $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_object();
            // Display animal data
            echo '<h2 class="section-heading">';
            echo $row->name;
            echo '</h2>';
            echo '<section> ';
            echo '<div class="card-separate">
            <div class="card-image-separate">'; ?>
            <img src="img/lost/<?php echo $row->image; ?>" alt="Card Image"> 
            <?php echo "</a> </div>";
            echo '<div class="card-description-separate">
            <h3>'; ?> <?php echo $row->name; ?> <?php echo '</h3> </a>';
            echo "<table>";
            echo "<tr>";
            echo "<td> Species: " . $row->species . "</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td> Breed: " . $row->breed . "</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td> Gender: " . $row->gen . "</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td> Description: " . $row->description . "</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td> County: " . $row->city . "</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td> Address: " . $row->location . "</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td> Owner's Contact: " . $row->contact . "</td>";
            echo "</tr>";
            echo "</table>";
            echo "<br>";
            echo '</div> </div>';
        } else {
            echo $conn->error;
        }
        ?>
        </section>
        <!-- Footer -->
        <footer>
            <div id="left-footer">
                <p>
                <ul>
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="#report">Post an Announcement</a>
                    </li>
                    <li>
                        <a href="lost.php">Lost Animals</a>
                    </li>
                    <li>
                        <a href="found.php">Found Animals</a>
                    </li>
                    <li>
                        <a href="adopt.php">Animals for Adoption</a>
                    </li>
                    <li>
                        <a href="profile.php">My Profile</a>
                    </li>
                    <li>
                        <a href="logout.php">Logout</a>
                    </li>
                </ul>
                </p>
            </div>
            
        </footer>
    </main>
    <script src="main.js"></script>
</body>
</html>
