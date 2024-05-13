<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Dashboard</title>
    <link rel="stylesheet" href="./styles/member_dash.css">
    <!-- Include any additional stylesheets -->
</head>

<body>
    <header>
        <!-- Include navigation bar -->
        <?php include("./memberNav.php"); ?>
    </header>
    <div class="container">
        <div class="dashboard-content">
            <h2>Welcome, Member!</h2>
            <p>This is your member dashboard. You can access various features related to your membership here.</p>
            <!-- Example of member-specific features -->
            <ul>
                <li><a href="borrowForm.html"> Borrow Books</a></li>
                <li><a href="fine.php">Fine</a></li>
                <!-- <li><a href="#">View Account Details</a></li> -->
                <!-- Add more links as needed -->
            </ul>
            <!-- Logout button -->
            <form action="logout.php" method="post">
                <input type="submit" value="Logout" class="logout-btn">
            </form>
        </div>
    </div>
</body>

</html>
