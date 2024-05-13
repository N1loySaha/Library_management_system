<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookId = $_POST['book_id'];

    $deleteBookQuery = "DELETE FROM book WHERE book_id = ?";
    $stmt = mysqli_prepare($conn, $deleteBookQuery);
    mysqli_stmt_bind_param($stmt, "i", $bookId);

    if (mysqli_stmt_execute($stmt)) {
        echo "Book with ID: " . $bookId . " has been successfully removed.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    echo "Invalid request method";
}
?>
