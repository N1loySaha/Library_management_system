<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Borrowing Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }
        h1 {
            text-align: center;
            margin-top: 20px;
        }
        form {
            width: 50%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Edit Borrowing Information</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
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

        // Fetch borrowing information based on borrowing ID
        if(isset($_GET['borrowed_id'])) {
            $borrowed_id = $_GET['borrowed_id'];
            $sql = "SELECT * FROM borrows WHERE borrowed_id = $borrowed_id";
            $result = $conn->query($sql);
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
        ?>
        <input type="hidden" name="borrowed_id" value="<?php echo $row['borrowed_id']; ?>">
        Borrower ID: <input type="text" name="member_id" value="<?php echo $row['member_id']; ?>"><br><br>
        Borrowed Date: <input type="text" name="borrowed_date" value="<?php echo $row['borrowed_date']; ?>"><br><br>
        Return Date: <input type="text" name="return_date" value="<?php echo $row['return_date']; ?>"><br><br>
        Fine Amount: <input type="text" name="fine_amount" value="<?php echo isset($row['fine']) ? $row['fine'] : ''; ?>"><br><br>
        <input type="submit" value="Update">
        <?php
            } else {
                echo "Borrowing information not found.";
            }
        } else {
            echo "Borrowed ID not provided.";
        }

        // Close database connection
        $conn->close();
        ?>
    </form>
</body>
</html>
