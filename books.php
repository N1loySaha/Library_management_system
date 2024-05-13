<?php
// Establish connection to the database
$servername = "localhost";
$username = "root"; // Default username is "root"
$password = ""; // No password set by default
$dbname = "library"; // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve all books from the database with authors
$sql = "
    SELECT b.book_id, b.book_name, b.image_url, GROUP_CONCAT(CONCAT(a.a_first_name, ' ', a.a_last_name) SEPARATOR ', ') AS author_name
    FROM book b 
    LEFT JOIN writes w ON b.book_id = w.book_id
    LEFT JOIN author a ON w.author_id = a.author_id
    GROUP BY b.book_id, b.book_name, b.image_url
";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Books</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="./styles/index.css">
    <style>
        .search-form {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        
        .search-form input[type="text"] {
            width: 400px;
            padding: 15px;
            font-size: 16px;
            border: 2px solid #ccc;
            border-radius: 5px;
            outline: none;
        }
        
        .search-form button {
            padding: 15px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        
        .search-form button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1>BOOK HEAVEN</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="books.php">Books</a></li>
                    <li><a href="leaderboard.php">Reader's Leaderboard</a></li>
                    <li><a href="category.php">Categories</a></li>
                    <li><a href="review.php">Reviews</a></li>
                    <li><a href="publisher.php">Publishers</a></li>
                    <li><a href="login.html">Login</a></li>
                    <!-- <li><a href="#">Register</a></li> -->

                </ul>
            </nav>
        </div>
    </header>

    <section class="search-bar">
        <div class="container">
            <form class="search-form" action="search.php" method="GET">
                <input type="text" name="search_query" placeholder="Search by Book Title or Author Name">
                <button type="submit" class="btn">Search</button>
            </form>
        </div>
    </section>

    <section class="books">
        <div class="container">
            <h2>All Books</h2>
            <table>
                <thead>
                    <tr>
                        <th>Image</th> <!-- New column for book image -->
                        <th>Title</th>
                        <th>Author</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td><img src='{$row['image_url']}' alt='Book Image' style='width: 100px;'></td>"; // Display book image
                            echo "<td>{$row['book_name']}</td>";
                            echo "<td>{$row['author_name']}</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No books found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2024 Online Library. All Rights Reserved.</p>
        </div>
    </footer>
</body>
</html>

<?php
// Close database connection
$conn->close();
?>
