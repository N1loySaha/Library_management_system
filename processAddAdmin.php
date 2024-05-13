<?php
include 'config.php'; // Include database configuration file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $adminId = trim($_POST["admin_id"]);
    $adminPass = trim($_POST["admin_password"]);
    $fname = trim($_POST['f_name']);
    $lname = trim($_POST['l_name']);
    $email = trim($_POST['email']);

    // Validate input (you can add more validation)
    if (empty($adminId) || empty($adminPass) || empty($fname)) {
        echo "Admin ID, Password, First Name are required";
        exit;
    }

    // Prepare and bind the statement
    $query = "INSERT INTO `admin` (`admin_id`, `admin_password`, `a_first_name`, `a_last_name`, `email`) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sssss", $adminId, $adminPass, $fname, $lname, $email);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        // echo "New admin added successfully";
        echo "<script> alert('New admin added successfully.');
    setTimeout(function() {
        window.location.href = './manageAdmin.php';
    }, 100);

    </script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Close statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>

<!-- sabid -->