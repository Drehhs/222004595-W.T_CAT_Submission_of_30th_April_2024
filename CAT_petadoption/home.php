
<!-- these codes designed by ABASABEZA Honore Reg NO 222004595-->
<?php //verification if user is logged in
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
    <!-- css -->
    <link rel="stylesheet" href="style.css">
    <title>Home</title>
</head>

<body>
    <!-- Menu -->
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
        </ul>
    </nav>
    <!-- display  -->
    <div id="banner">
        <h1>Help a pet find a loving home</h1>
        <h3>Post an ad now or browse existing ads</h3>
    </div>
    <main>
        <!-- Section 0 - Post announcement-->
        <p id="report"><br></p>
        <h2 class="section-heading">Post an ad</h2>
        <section id="section-source">
            <a href="lostreport.php" class="btn-report" style="background: #ffcf94; border: 3px solid #e2b986;">Lost animal</a>
            <a href="foundreport.php" class="btn-report" style="background: #e1bbd2; border: 3px solid #cdaabf;">Animal found</a>
            <a href="adoptreport.php" class="btn-report" style="background: #99d1ce; border: 3px solid #a2bdc5;">Animal for adoption</a>
        </section>
        <!-- Section 1 - Lost animals -->
        <a href="lost.php">
            <h2 class="section-heading">Recently lost animals</h2>
        </a>

        <!-- Display cards last 3 animals posted -->
        <section>


            <?php
            // Database connection
            include('config.php');

            // Query 
            $result = mysqli_query($conn, "SELECT * FROM lost ORDER BY id desc LIMIT 3");
            while ($row = mysqli_fetch_array($result)) {

                // Display animal data
                echo '<div class="card">   <div class="card-image">';
                echo "<a href=lostinfo.php?id=$row[id]>"; ?>
                <img src="img/lost/<?php echo $row["image"]; ?>"
                 alt="Card Image"> <?php echo "</a> </div>";
                echo '<div class="card-description">
                <h3>'; ?> <?php echo $row['name']; ?>
            <?php echo '</h3> </a>';
                echo "<table>";
                echo "<tr>";
                echo "<td> Specie: " . $row['species'] . "</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td> Breed: " . $row['breed'] . "</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td> Gen: " . $row['gen'] . "</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td> Description: " . $row['description'] . "</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td> City: " . $row['city'] . "</td>";
                echo "</tr>";
                
                echo "<tr>";
                echo "<td> Contact: " . $row['contact'] . "</td>";
                echo "</tr>";
                echo "</table>";
                echo "<br>";
                echo "<a href=lostinfo.php?id=$row[id] class=btn-readmore>Detalii</a>";
                echo '</div> </div>';
            }
            mysqli_close($conn);
            ?>
        </section>
        <!-- Section 2 - Animals found -->
        <a href="found.php">
            <h2 class="section-heading">Animale găsite recent</h2>
        </a>
        <!-- Display cards last 3 animals posted-->
        <section>
            <?php
            // Database connection
            include('config.php');

            // Query 
            $result = mysqli_query($conn, "SELECT * FROM found ORDER BY id desc LIMIT 3");
            while ($row = mysqli_fetch_array($result)) {
                // Display  data

                echo '<div class="card">
                <div class="card-image">';
                echo "<a href=foundinfo.php?id=$row[id]>"; ?>
                <img src="img/found/<?php echo $row["image"]; ?>" alt="Card Image">
                <?php echo "</a> </div>";
                echo '<div class="card-description">
                <h3>'; ?> <?php echo $row['name']; ?>
                <?php echo '</h3> </a>';
                echo "<table>";
                echo "<tr>";
                echo "<td> Specie: " . $row['species'] . "</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td> Breed: " . $row['breed'] . "</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td> Gen: " . $row['gen'] . "</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td> Description: " . $row['description'] . "</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td> city: " . $row['city'] . "</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td> The date it was found: " . $row['date'] . "</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td> Contact: " . $row['contact'] . "</td>";
                echo "</tr>";
                echo "</table>";
                echo "<br>";
                echo "<a href=foundinfo.php?id=$row[id] class=btn-readmore>Detalii</a>";
                echo '</div> </div>';
            }
            mysqli_close($conn);
            ?>
        </section>

        <!-- Section 3 - Animals for adoption -->
        <a href="adopt.php">
            <h2 class="section-heading">Animals given up for adoption recently</h2>
        </a>

        <!-- Display cards last 3 animals posted -->
        <section>
            <?php
            // DB Connection
            include('config.php');
            // Query 
            $result = mysqli_query($conn, "SELECT * FROM adopt ORDER BY id desc LIMIT 3 ");
            while ($row = mysqli_fetch_array($result)) {
                // dispaly animal
                echo '<div class="card">
                <div class="card-image">';
                echo "<a href=adoptinfo.php?id=$row[id]>"; ?>
                <img src="img/adopt/<?php echo $row["image"]; ?>" alt="Card Image"> <?php echo "</a> </div>";
                echo '<div class="card-description">
                <h3>'; ?> <?php echo $row['name']; ?> 
                <?php echo '</h3> </a>';
                echo "<table>";
                echo "<tr>";
                echo "<td> Specie: " . $row['species'] . "</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td> Breed: " . $row['breed'] . "</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td> Gen: " . $row['gen'] . "</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td> Description: " . $row['description'] . "</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td> City: " . $row['city'] . "</td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td> Contact: " . $row['contact'] . "</td>";
                echo "</tr>";
                echo "</table>";
                echo "<br>";
                echo "<a href=adoptinfo.php?id=$row[id] class=btn-readmore>Detalii</a>";
                echo '</div> </div>';
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
    </main>
    <script src="main.js"></script>
</body>
</html>