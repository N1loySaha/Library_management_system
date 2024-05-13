<!-- Sabid Mahmud -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Member</title>
    <link rel="stylesheet" href="./styles/main.css">
    <style>
        /* Dropdown styles */
        .dropdown-content {
            display: none;
            position: absolute;
            flex-direction: column;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
            left: auto;
            right: 0;
        }

        #login:hover .dropdown-content {
            display: block;
            left: auto;
            right: 0;
        }
    </style>
</head>

<body>
    <header>
        <h2 id="titleheadline">Library</h2>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="books.php">Books</a></li>
                <li><a href="leaderboard.php">Reader's Leaderboard</a></li>
                <li><a href="#contact-section">Contact</a></li>

                <li id="login">
                    <?php
                    session_start();
                    // Check if the user is logged in
                    if (isset($_SESSION['username']) && $_SESSION['login_type'] == 'member') {
                        // If logged in, display the username and dropdown menu
                        echo '<a href="#">' . $_SESSION['username'] . '</a>';
                        echo '<div class="dropdown-content">';
                        if ($_SESSION['login_type'] == 'member') {
                            echo '<a href="#">Dashboard</a>';
                            echo '<a href="#">Profile</a>';
                        } else {
                            echo '<a href="#">Dashboard</a>';
                        }
                        echo '<a href="./logout.php">Logout</a>';
                        echo '</div>';
                    } else {
                        // If not logged in, redirect to login page
                        header('Location: ./login.html');
                    }
                    ?>
                </li>
            </ul>
        </nav>
    </header>

    <!-- Your other content here -->

    <script>
        // Close the dropdown menu if the user clicks outside of it
        window.onclick = function (event) {
            if (!event.target.matches('#login')) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.style.display === "block") {
                        openDropdown.style.display = "none";
                    }
                }
            }
        }
    </script>

</body>

</html>


<!-- sabid -->