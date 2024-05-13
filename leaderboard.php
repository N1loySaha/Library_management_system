<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BOOK HEAVEN</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="./styles/index.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }
    header {
      background-color: #333;
      color: #fff;
      padding: 20px 0;
      text-align: left;
    }
    .container {
      width: 80%;
      margin: 0 auto;
    }
    nav ul {
      list-style-type: none;
      padding: 0;
      margin: 0;
      text-align: left;
    }
    nav ul li {
      display: inline;
      margin: 0 10px;
    }
    nav ul li a {
      text-decoration: none;
      color: #fff;
    }
    .leaderboard {
      background-color: #fff;
      padding: 20px;
      margin-top: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
    }
    .leaderboard h2 {
      text-align: center;
      margin-bottom: 20px;
    }
    .leaderboard ol {
      list-style-type: none;
      padding: 0;
      margin: 0;
    }
    .leaderboard ol li {
      padding: 10px 20px;
      margin-bottom: 10px;
      background-color: #f9f9f9;
      border-radius: 5px;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
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
          <li><a href="login.php">Login</a></li>
          <li><a href="register.php">Register</a></li>
          
        </ul>
      </nav>
    </div>
  </header>

  <section class="leaderboard">
    <div class="container">
      <h2>Top 5 Readers</h2>
      <ol>
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

        include("./config.php");

        // Retrieve top 5 members with the most borrowed books
        $sql_leaderboard = "
            SELECT first_name, last_name
            FROM member
            ORDER BY total_book_borrow_count DESC
            LIMIT 5
        ";
        $result = $conn->query($sql_leaderboard);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $first_name = $row['first_name'];
                $last_name = $row['last_name'];
                echo "<li>{$first_name} {$last_name}</li>";
            }
        } else {
            echo "<li>No data found</li>";
        }
        // Close database connection
        $conn->close();
        ?>
      </ol>
    </div>
  </section>


</body>
</html>