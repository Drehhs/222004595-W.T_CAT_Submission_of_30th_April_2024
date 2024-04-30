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
    <title>Found Animals</title>
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
                <a href="feedbackform.php">feedback</a>
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
                <a href="feedbackform.php">feedback</a>
            </li>
            <li>
                <a href="profile.php">My Profile</a>
            </li>
        </ul>
    </nav>
    <main>
        <!-- Section - Found Animals -->
        <br><br><br><br>
        <h2 class="section-heading">Found Animals</h2>
        <!-- Search bar -->
        <section>
            <div class="search_form">
                <form autocomplete="off" action="foundsearch.php" method="GET" target="_self">
                    <input type="text" name="search" value="<?php if (isset($_GET['search'])) {
                                                                echo $_GET['search'];
                                                            } ?>" class="form-control" placeholder="Search">
                    <button type="submit" class="btn-readmore">Search</button>
                </form>
            </div>
        </section>
        <!-- Display animal cards -->                                                    
        <section>
            <?php
            // Connect to the database
            include('config.php');
            // Pagination
            $results_per_page = 6;
            if (isset($_GET["page"])) {
                $page  = $_GET["page"];
            } else {
                $page = 1;
            };
            $start_from = ($page - 1) * $results_per_page;
            // Database query
            $sql = "SELECT * FROM found ORDER BY id desc LIMIT $start_from, " . $results_per_page;
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) {
                // Display animal data
                echo '<div class="card">
                <div class="card-image">';
                echo "<a href=foundinfo.php?id=$row[id]>"; ?>
                <img src="img/found/<?php echo $row["image"]; ?>" alt="Card Image"> <?php echo "</a> </div>";
                echo '<div class="card-description">
            <h3>'; ?> <?php echo $row['name']; ?> 
            <?php echo '</h3> </a>';
                echo "<table>";
                echo "<tr>";
                echo "<td> Species: " . $row['species'] . "</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td> Breed: " . $row['breed'] . "</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td> Gender: " . $row['gen'] . "</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td> Description: " . $row['description'] . "</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td> County: " . $row['city'] . "</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td> Address: " . $row['location'] . "</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td> Date Found: " . $row['date'] . "</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td> Owner's Contact: " . $row['contact'] . "</td>";
                echo "</tr>";
                echo "</table>";
                echo "<br>";
                echo "<a href=foundinfo.php?id=$row[id] class=btn-readmore>Details</a>";
                echo '</div> </div>';
            }
            ?>
        </section>
        <!-- Page navigation -->
        <section class="pagination">
            <?php
            $sql2 = "SELECT COUNT(id) AS total FROM found";
            $result = $conn->query($sql2);
            $row = $result->fetch_assoc();
            $total_pages = ceil($row["total"] / $results_per_page);
            if ($page - 1 >= 1) {
                echo "<td><a href=" . $_SERVER['PHP_SELF'] . "?page=" . ($page - 1) . ">Previous</a></td>";
            }
            for ($i = 1; $i <= $total_pages; $i++) { 
                echo "<a href='found.php?page=" . $i . "'";
                if ($i == $page)  echo " class='curPage'";
                echo ">" . $i . "</a> ";
            };
            if ($page + 1 <= $total_pages) {
                echo "<td><a href=" . $_SERVER['PHP_SELF'] . "?page=" . ($page + 1) . ">Next</a></td>";
            }
            mysqli_close($conn);
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
                        <a href="feedbackform.php">feedback</a>
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
