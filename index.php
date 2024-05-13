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

include "config.php";

// Retrieve and display the most popular books
$sql_most_popular_books = "
    SELECT b.book_id, b.book_name, b.image_url, GROUP_CONCAT(DISTINCT CONCAT(a.a_first_name, ' ', a.a_last_name) SEPARATOR ', ') AS author_name, b.borrow_count
    FROM book b 
    LEFT JOIN writes w ON b.book_id = w.book_id
    LEFT JOIN author a ON w.author_id = a.author_id
    GROUP BY b.book_id
    ORDER BY b.borrow_count DESC 
    LIMIT 5
";

$result = $conn->query($sql_most_popular_books);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Online Library</title>
  <link rel="stylesheet" href="./styles/index.css">
  <style>
    .search-form input[type="text"] {
      width: 300px; /* Adjust the width as needed */
      padding: 10px; /* Add padding for better appearance */
      font-size: 16px; /* Adjust font size */
    }
    /* Style for the contact section */
    #contact-section {
      padding: 50px 0;
    }
    .contact-card {
      display: flex;
      justify-content: space-around;
      align-items: center;
      margin-bottom: 20px;
    }
    .contact-card img {
      width: 100px;
      border-radius: 50%;
    }
    .contact-card div {
      flex-grow: 1; /* Allow the div to grow and take up remaining space */
      padding-left: 20px; /* Add some padding to the left for better spacing */
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
          <li><a href="#contact-section">Contact</a></li>
          <!-- <li><a href="./admin_dash.php">Admin Dashboard</a></li>
          <li><a href="./member_dash.php">Member Dashboard</a></li> -->
          
          <li><a href="./login.html">Login</a></li>
          <li><a href="register.html">Register</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <section class="hero">
    <div class="container">
      <h2>Welcome to the realm of Enlightenment!</h2>
      <p>Explore our vast collection of books and resources.</p>
      <form class="search-form" action="search.php" method="GET">
        <input type="text" name="search_query" placeholder="Search by Book Title or Author Name">
        <button type="submit" class="btn">Search</button>
      </form>
    </div>
  </section>

  <section class="popular-books">
    <div class="container">
      <h2>Most Popular Books</h2>
      <table>
        <thead>
          <tr>
            <th>Book Image</th>
            <th>Book Name</th>
            <th>Author's Name</th>
            <th>Book ID</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  $book_id = $row['book_id'];
                  $book_name = $row['book_name'];
                  $author_name = $row['author_name'];
                  $borrow_count = $row['borrow_count'];
                  $img_link = $row['image_url'];
                  // Fetch additional details from the book table based on book ID
                  echo "<tr>";
                  echo "<td><img src='$img_link' alt='Book Image' style='width: 100px;'></td>";
                  echo "<td>{$book_name}</td>";
                  echo "<td>{$author_name}</td>";
                  echo "<td>{$book_id}</td>";
                  echo "</tr>";
              }
          } else {
              echo "<tr><td colspan='4'>No popular books found</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </section>

  <section id="contact-section">
    <div class="container">
      <h2>Contact Us</h2>
      <div class="contact-card">
        <img src="person1.jpg" alt="Person 1">
        <div>
          <h3>Md. Tanvirul Islam</h3>
          <p>Email: john@example.com</p>
        </div>
      </div>
      <div class="contact-card">
        <img src="person2.jpg" alt="Person 2">
        <div>
          <h3>Sabid Mahmud</h3>
          <p>Email: jane@example.com</p>
        </div>
      </div>
      <div class="contact-card">
        <img src="person3.jpg" alt="Person 3">
        <div>
          <h3>Mahedi Mostafa</h3>
          <p>Email: michael@example.com</p>
        </div>
      </div>
      <div class="contact-card">
        <img src="person4.jpg" alt="Person 4">
        <div>
          <h3>Niloy Saha</h3>
          <p>Email: alice@example.com</p>
        </div>
      </div>
      <div class="contact-card">
        <img src="person5.jpg" alt="Person 5">
        <div>
          <h3>Shuvashis Basak</h3>
          <p>Email: david@example.com</p>
        </div>
      </div>
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