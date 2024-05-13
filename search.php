<?php
// // Establish connection to the database
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

include ("./config.php");

// Retrieve the search query from the URL
$search_query = $_GET['search_query'];

// Query to search for books by title or author name
$sql_search_books = "
    SELECT b.book_id, b.book_name, GROUP_CONCAT(CONCAT(a.a_first_name, ' ', a.a_last_name) SEPARATOR ', ') AS author_name, b.description, b.image_url
    FROM book b
    INNER JOIN writes w ON b.book_id = w.book_id
    INNER JOIN author a ON w.author_id = a.author_id
    WHERE b.book_name LIKE '%$search_query%' OR CONCAT(a.a_first_name, ' ', a.a_last_name) LIKE '%$search_query%'
    GROUP BY b.book_id
";
$result = $conn->query($sql_search_books);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Search Results</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="./styles/index.css">
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }

    .book img {
      max-width: 150px;
    }
  </style>
</head>
<body>
  <header>
    <div class="container">
      <h1>BOOK HAVEN</h1>
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

  <section class="search-results">
    <div class="container">
      <h2>Search Results</h2>
      <table>
        <thead>
          <tr>
            <th>Book Cover</th>
            <th>Book Name</th>
            <th>Author</th>
            <th>Description</th>
            <th>View Details</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if ($result->num_rows > 0) {
              // Display search results
              while ($row = $result->fetch_assoc()) {
                  $book_name = $row['book_name'];
                  $author_name = $row['author_name'];
                  $description = $row['description'];
                  $image_url = $row['image_url'];
                  $book_id = $row['book_id'];
                  echo "<tr>";
                  echo "<td class='book'><img src='{$image_url}' alt='Book Cover'></td>";
                  echo "<td>{$book_name}</td>";
                  echo "<td>{$author_name}</td>";
                  echo "<td>{$description}</td>";
                  echo "<td><a href='book_details.php?book_id={$book_id}'>View Details</a></td>";
                  echo "</tr>";
              }
          } else {
              echo "<tr><td colspan='4'>No results found.</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </section>

</body>
</html>

<?php
// Close database connection
$conn->close();
?>