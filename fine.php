<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrowing Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Borrowing Information</h1>
    <table border="1">
        <tr>
            <th>Borrowing ID</th>
            <th>Borrower ID</th>
            <th>Borrower Name</th>
            <th>Borrowed Book</th>
            <th>Borrowing Date</th>
            <th>Returning Date</th>
            <th>Fine</th>
        </tr>
        <?php
        // Establish database connection
        // $servername = "localhost";
        // $username = "root";
        // $password = "";
        // $database = "library";
        // $conn = new mysqli($servername, $username, $password, $database);

        // // Check connection
        // if ($conn->connect_error) {
        //     die("Connection failed: " . $conn->connect_error);
        // }
        include("./config.php");

        // Fetch borrowing information
        $sql = "SELECT borrows.borrowed_id, borrows.member_id, member.first_name, member.last_name, book.book_name, borrows.borrowed_date, borrows.return_date, fine.fine_amount 
                FROM borrows
                INNER JOIN member ON borrows.member_id = member.member_id
                INNER JOIN borrow_info ON borrows.borrowed_id = borrow_info.borrowed_id
                INNER JOIN book ON borrow_info.book_id = book.book_id
                LEFT JOIN fine ON borrows.borrowed_id = fine.borrowed_id";
        $result = $conn->query($sql);

        // Display borrowing information in a table
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['borrowed_id']}</td>";
                echo "<td>{$row['member_id']}</td>";
                echo "<td>{$row['first_name']} {$row['last_name']}</td>";
                echo "<td>{$row['book_name']}</td>";
                echo "<td>{$row['borrowed_date']}</td>";
                echo "<td>{$row['return_date']}</td>";
                // echo "<td>{$row['fine_amount']}</td>";
                echo "<td>" . ($row['fine_amount'] ?? '0.00') . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No borrowing information available</td></tr>";
        }

        // Close database connection
        $conn->close();
        ?>
    </table>
    <br>
    <button onclick="editBorrowing()">Edit Borrowing</button>

    <script>
        function editBorrowing() {
            var borrowed_id = prompt("Please enter the Borrowed ID:");
            if (borrowed_id != null) {
                window.location.href = "edit_borrowing_table.php?borrowed_id=" + borrowed_id;
            }
        }
    </script>
</body>
</html>