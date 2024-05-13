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
$sql = "SELECT r.review_id, r.review_date, b.book_name, r.rating, r.review_text, m.first_name
        FROM reviews r
        INNER JOIN book b ON r.book_id = b.book_id
        INNER JOIN member m ON r.member_id = m.member_id";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="./styles/index.css">
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
            width: 90%;
            margin: 20px auto;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
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
            transition: background-color 0.3s ease;
        }

        tr:hover td {
            color: #333;
        }

        tr:hover td:first-child {
            background-color: #ffcc00; /* Yellow */
        }

        tr:hover td:nth-child(2) {
            background-color: #17a2b8; /* Teal */
        }

        tr:hover td:nth-child(3) {
            background-color: #28a745; /* Green */
        }

        tr:hover td:nth-child(4) {
            background-color: #dc3545; /* Red */
        }
    </style>
</head>

<body>
    <h2>Reviews</h2>
    <table>
        <tr>
            <th>Review ID</th>
            <th>Review Date</th>
            <th>Book Name</th>
            <th>Rating</th>
            <th>Review Text</th>
            <th>Member Name</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["review_id"] . "</td>";
                echo "<td>" . $row["review_date"] . "</td>";
                echo "<td>" . $row["book_name"] . "</td>";
                echo "<td>" . $row["rating"] . "</td>";
                echo "<td>" . $row["review_text"] . "</td>";
                echo "<td>" . $row["first_name"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No reviews found</td></tr>";
        }
        ?>
    </table>
</body>

</html>

<?php
// Close connection
$conn->close();
?>
