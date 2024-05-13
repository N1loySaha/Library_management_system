<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $adminId = $_POST["admin_id"];

    // Validate input (you can add more validation)
    if (empty($adminId)) {
        echo "Member ID is required";
        exit;
    }

    // Prepare and bind the statement
    $query = "DELETE FROM `admin` WHERE `admin_id` = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $adminId);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            // echo "An Admin with ID" . $adminID . " removed successfully";
            echo "<script> alert('Admin with ID: $adminID is removed successfully.');
    setTimeout(function() {
        window.location.href = './manageAdmin.php';
    }, 100);

    </script>";
        } else {
            echo "No Admin with ID " . $adminId . " is found in the database.";
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Close statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>


<!-- sabid -->