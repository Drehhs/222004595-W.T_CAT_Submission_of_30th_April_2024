<!-- these codes designed by ABASABEZA Honore Reg NO 222004595-->
<?php // check if the user is logged in
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
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <link rel="stylesheet" href="style.css">
    <title>Adoptions</title>
</head>
<body>
    <!-- navigation menu -->
    <div id="slideout-menu">
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
                <a href="found.php">Found animals</a>
            </li>
            <li>
                <a href="adopt.php">Animals for adoption</a>
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
               <a href="home.php">Home</a>
            </li>
            <li>
                <a href="home.php#report">Post an ad</a>
            </li>
            <li>
                <a href="lost.php">Lost animals</a>
            </li>
            <li>
                <a href="found.php">Found animals</a>
            </li>
            <li>
                <a href="adopt.php">Animals for adoption</a>
            </li>
            <li>
                <a href="profile.php">My profile</a>
            </li>
        </ul>
    </nav>
    <main>
        <!-- Section - Animals for adoption -->
        <br><br><br><br>
        <h2 class="section-heading">Animals available for adoption</h2>
        <!-- Search bar -->
        <section>
            <div class="search_form">
                <form autocomplete="off" action="adoptsearch.php" method="GET" target="_self">
                    <input type="text" name="search" value="<?php if (isset($_GET['search'])) {
                                                                echo $_GET['search'];
                                                            } ?>" class="form-control" placeholder="Search">
                    <button type="submit" class="btn-readmore">Search</button>
                    <a href="adopt.php" class="btn-readmore">Clear filter</a>
                </form>
            </div>
        </section>
        <!-- Display animal cards -->                                                        
        <section>
            <?php
            // Connect to the database
            include('config.php');
            // Search in the database
            if (isset($_GET['search'])) {
                $filtervalues = $_GET['search'];
                $query = "SELECT * FROM adopt WHERE CONCAT(name,species,breed,gen,city,location,description) LIKE '%$filtervalues%'";
                $query_run = mysqli_query($conn, $query);
                if (mysqli_num_rows($query_run) > 0) {
                    foreach ($query_run as $items) {
                        // Display animal data
                        echo '<div class="card">
				        <div class="card-image">';
                        echo "<a href=adoptinfo.php?id=$items[id]>"; ?>
                        <img src="img/adopt/<?php echo $items['image']; ?>" alt="Card Image"> <?php echo "</a> </div>";
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
                        echo "<td> County: " . $items['city'] . "</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td> Address: " . $items['location'] . "</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td> Owner's contact: " . $items['contact'] . "</td>";
                        echo "</tr>";
                        echo "</table>";
                        echo "<br>";
                        echo "<a href=adoptinfo.php?id=$items[id] class=btn-readmore>Details</a>";
                        echo '</div> </div>';
                    }
                } else {
                    echo '<p>No results found</p>';
                }
            }
            mysqli_close($con);
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
                        <a href="index.php#report">Post an ad</a>
                    </li>
                    <li>
                        <a href="lost.php">Lost animals</a>
                    </li>
                    <li>
                        <a href="found.php">Found animals</a>
                    </li>
                    <li>
                        <a href="adopt.php">Animals for adoption</a>
                    </li>
                    <li>
                        <a href="profile.php">My profile</a>
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
