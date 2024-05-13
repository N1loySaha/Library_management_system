<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$database = "library";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch data
$sql = "SELECT p.pub_name AS publisher_name, p.pub_info AS publisher_info, b.book_name AS book_name
        FROM publisher p
        INNER JOIN publishes ps ON p.publishers_id = ps.publishers_id
        INNER JOIN book b ON ps.book_id = b.book_id";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publishers and Books</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
            color: #333;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
            color: #007bff;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #fff;
            text-transform: uppercase;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e2e6ea;
        }
    </style>
</head>

<body>
    <h2>Publishers and Books</h2>
    <table>
        <tr>
            <th>Publisher Name</th>
            <th>Publisher Info</th>
            <th>Book Name</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["publisher_name"] . "</td>";
                echo "<td>" . $row["publisher_info"] . "</td>";
                echo "<td>" . $row["book_name"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No data found</td></tr>";
        }
        ?>
    </table>
</body>

</html>

<?php
// Close connection
$conn->close();
?>
