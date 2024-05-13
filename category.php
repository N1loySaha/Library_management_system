<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Categories</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }
        h1, h2 {
            text-align: center;
        }
        form {
            margin: 20px auto;
            text-align: center;
        }
        select {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 80%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <h1>Book Categories</h1>
    <form method="get">
        <label for="category">Select a category:</label>
        <select name="category" id="category">
            <?php
            // Establish database connection
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "library";
            $conn = new mysqli($servername, $username, $password, $database);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch all categories from the database
            $sql = "SELECT DISTINCT category FROM category";
            $result = $conn->query($sql);

            // Generate options for the select dropdown
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value=\"{$row['category']}\">{$row['category']}</option>";
                }
            } else {
                echo "<option>No categories available</option>";
            }

            // Close database connection
            $conn->close();
            ?>
        </select>
        <button type="submit">Show Books</button>
    </form>

    <h2>Books</h2>
    <?php
    // Check if a category has been selected
    if (isset($_GET['category'])) {
        $category = $_GET['category'];

        // Establish database connection
        $conn = new mysqli($servername, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch books for the selected category
        $sql = "SELECT book.book_name, CONCAT(author.a_first_name, ' ', author.a_last_name) AS author_name, book.image_url FROM book 
                JOIN book_category ON book.book_id = book_category.book_id 
                JOIN author ON book.author_id = author.author_id 
                WHERE category = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $category);
        $stmt->execute();
        $result = $stmt->get_result();

        // Display books in a table format if available, otherwise show a message
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Book Name</th><th>Author Name</th><th>Image URL</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['book_name']}</td>";
                echo "<td>{$row['author_name']}</td>";
                echo "<td>{$row['image_url']}</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No books from this category</p>";
        }

        // Close prepared statement and database connection
        $stmt->close();
        $conn->close();
    }
    ?>
</body>
</html>
