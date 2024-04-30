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
                <a href="home.php#report">Post an Ad</a>
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
                <div id="search-icon">
                </div>
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
                <a href="index.php#report">Post an Ad</a>
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
                <div id="search-icon">
                </div>
            </li>
        </ul>
    </nav>
    <main>
        <!-- Section - Lost Animals -->
        <br><br><br><br>
        <h2 class="section-heading">Lost Animals</h2>
        <!-- Search bar -->
        <section>
            <div class="search_form">
                <form autocomplete="off" action="lostsearch.php" method="GET" target="_self">
                    <input type="text" name="search" value="<?php if (isset($_GET['search'])) {
                                                                echo $_GET['search'];
                                                            } ?>" class="form-control" placeholder="Search">
                    <button type="submit" class="btn-readmore">Search</button>
                    <a href="lost.php" class="btn-readmore">Clear Filter</a>
                </form>
            </div>
        </section>
        <!-- Display animal cards --> 
        <section>
            <?php
            // Database connection
            include('config.php');
            // Search in the database
            if (isset($_GET['search'])) {
                $filtervalues = $_GET['search'];
                $query = "SELECT * FROM lost WHERE CONCAT(name,species,breed,gen,city,description) LIKE '%$filtervalues%'";
                $query_run = mysqli_query($conn, $query);
                if (mysqli_num_rows($query_run) > 0) {
                    foreach ($query_run as $items) {
                        // Display animal data
                        echo '<div class="card">
				        <div class="card-image">';
                        echo "<a href=lostinfo.php?id=$items[id]>"; ?>
                        <img src="img/lost/<?php echo $items['image']; ?>" alt="Card Image"> <?php echo "</a> </div>";
                        echo '<div class="card-description">
				        <h3>'; ?> <?php echo $items['name']; ?> 
                        <?php echo '</h3>';
                        echo "<table>";
                        echo "<tr>";
                        echo "<td> Species: " . $items['species'] . "</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td> Breed: " . $items['breed'] . "</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td> Gender: " . $items['gen'] . "</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td> Description: " . $items['description'] . "</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td> City: " . $items['city'] . "</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td> Address: " . $items['location'] . "</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td> Owner's Contact: " . $items['contact'] . "</td>";
                        echo "</tr>";
                        echo "</table>";
                        echo "<br>";
                        echo "<a href=lostinfo.php?id=$items[id] class=btn-readmore>Details</a>";
                        echo '</div> </div>';
                    }
                } else {
                    echo '<p>No results found</p>';
                }
                mysqli_close($conn);
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
                        <a href="index.php#report">Post an Ad</a>
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
