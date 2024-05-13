<?php
// Establish connection to the database
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "library"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Variable to store registration success message
$registration_message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $id = $conn->real_escape_string($_POST["id"]); // Escape input to prevent SQL injection
    $password = $conn->real_escape_string($_POST["password"]);
    $first_name = $conn->real_escape_string($_POST["first_name"]);
    $last_name = $conn->real_escape_string($_POST["last_name"]);
    $email = $conn->real_escape_string($_POST["email"]);
    $phone = $conn->real_escape_string($_POST["phone"]);

    // SQL query to insert data into the database
    $sql = "INSERT INTO member (member_id, member_password, first_name, last_name, email, phone)
            VALUES ('$id', '$password', '$first_name', '$last_name', '$email', '$phone')";

    if ($conn->query($sql) === TRUE) {
        // Registration successful, set success message
        $registration_message = "Registration successful!";
    } else {
        if ($conn->errno == 1062) { // Check for duplicate entry error
            $registration_message = "Error: Duplicate entry for member ID.";
        } else {
            $registration_message = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Result</title>
    <link rel="stylesheet" href="styles.css"> <!-- You can link your CSS file here if needed -->
</head>
<body>
    <div class="container">
        <h2>Registration Result</h2>
        <?php
        // Display registration message
        if (!empty($registration_message)) {
            echo "<p>$registration_message</p>";
            // Display login button if registration was successful
            if ($registration_message === "Registration successful!") {
                echo "<a href='login.html' class='btn'>Login</a>";
            }
        }
        ?>
    </div>
</body>
</html>
