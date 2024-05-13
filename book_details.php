<?php
// Establish connection to the database
// $servername = "localhost";
// $username = "root"; // Default username is "root"
// $password = ""; // No password set by default
// $dbname = "online_library_management_system"; // Database name

// // Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);

// // Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }
include("config.php");

// Retrieve the book ID from the URL
$book_id = $_GET['book_id'];

// Query to fetch book details
$sql_book_details = "
    SELECT b.*
    FROM book b
    WHERE b.book_id = '$book_id'
";
$result_book_details = $conn->query($sql_book_details);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Details</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="./styles/index.css">
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
          
          <li><a href="#">Login</a></li>
          <li><a href="#">Register</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <section class="book-details">
    <div class="container">
      <h2>Book Details</h2>
      <?php
      if ($result_book_details->num_rows > 0) {
          $row = $result_book_details->fetch_assoc();
          echo "<div class='book'>";
          echo "<h3>{$row['book_name']}</h3>";
          echo "<p><strong>Book ID:</strong> {$row['book_id']}</p>";
          echo "<p><strong>Description:</strong> {$row['description']}</p>";
          echo "<p><strong>Average Rating:</strong> {$row['average_rating']}</p>";
          echo "<p><strong>Language:</strong> {$row['language']}</p>";
          echo "<p><strong>Author ID:</strong> {$row['author_id']}</p>";
          echo "<p><strong>Borrow Count:</strong> {$row['borrow_count']}</p>";
          echo "<p><strong>Image URL:</strong> {$row['image_url']}</p>";
          echo "<p><strong>Number of Copies:</strong> {$row['no_of_copies']}</p>";
          echo "<p><strong>Publishing Year:</strong> {$row['year_of_publication']}</p>";

          echo "</div>";
      } else {
          echo "Book details not found.";
      }
      ?>
    </div>
  </section>

  </body>
</html>

<?php
// Close database connection
$conn->close();
?>