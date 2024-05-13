<?php
include 'config.php'; // Include database configuration file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $memberId = trim($_POST["member_id"]);
    $memberPass = trim($_POST["member_password"]);
    $fname = trim($_POST['f_name']);
    $lname = trim($_POST['l_name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST["phone"]);

    // Validate input (you can add more validation)
    if (empty($memberId) || empty($memberPass) || empty($fname) || empty($email)) {
        echo "Member ID, Password, First Name, and Email are required";
        exit;
    }

    // Prepare and bind the statement
    $query = "INSERT INTO `member` (`member_id`, `member_password`, `first_name`, `last_name`, `email`, `phone`) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssssss", $memberId, $memberPass, $fname, $lname, $email, $phone);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        // echo "Member added successfully";
        echo "<script> alert('New member added successfully.');
    setTimeout(function() {
        window.location.href = './manageMembers.php';
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
