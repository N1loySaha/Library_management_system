<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if book_id is provided in the POST request
    if (isset($_POST['book_id'])) {
        $bookId = $_POST['book_id'];

        // Step 1: Check for dependencies
        $checkDependencyQuery = "SELECT COUNT(*) FROM writes WHERE book_id = ?";
        $stmt = mysqli_prepare($conn, $checkDependencyQuery);
        mysqli_stmt_bind_param($stmt, "i", $bookId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $dependencyCount);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        // If there are dependencies, handle them (you can choose to cascade delete or restrict deletion)
        if ($dependencyCount > 0) {
            // Handle dependencies based on your application's requirements
            // For example, you might choose to cascade delete related records
            $deleteRelatedQuery = "DELETE FROM writes WHERE book_id = ?";
            $stmt = mysqli_prepare($conn, $deleteRelatedQuery);
            mysqli_stmt_bind_param($stmt, "i", $bookId);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }

        // Step 2: Delete the book
        $deleteBookQuery = "DELETE FROM book WHERE book_id = ?";
        $stmt = mysqli_prepare($conn, $deleteBookQuery);
        mysqli_stmt_bind_param($stmt, "i", $bookId);

        if (mysqli_stmt_execute($stmt)) {
            // echo "Book with ID $bookId has been successfully deleted.";
            echo '<script>
        
                alert("Book with id:' . $bookId . ' is deleted!");
                setTimeout(function() {
                    window.location.href = "./manageBooks.php";
                }, 100);
            
              </script>';

        } else {
            echo "Error: " . mysqli_error($conn);
        }

        // Close statement and connection
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    } else {
        echo "Book ID not provided.";
    }
} else {
    echo "Invalid request method.";
}
?>
