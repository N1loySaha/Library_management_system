<?php
include 'config.php'; 


if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $authorId = $_GET['id'];

    // Check if the author is referenced by any records in the book table
    $checkBookQuery = "SELECT COUNT(*) FROM writes WHERE author_id = ?";
    $stmt = mysqli_prepare($conn, $checkBookQuery);
    mysqli_stmt_bind_param($stmt, "i", $authorId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $count);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // If the author is referenced by any records in the book table, do not delete
    if ($count > 0) {
        // echo "Cannot delete author because there are books associated with this author.";
        
        echo '<script>
        
                alert("Cannot delete this author because there are books associated with this author.");
                
                setTimeout(function() {
                    window.location.href = "./manageAuthors.php";
                }, 1000);
              </script>';
        exit();
    }

    // If the author is not referenced by any records in the book table, proceed
    $deleteAuthorQuery = "DELETE FROM author WHERE author_id = ?";
    $stmt = mysqli_prepare($conn, $deleteAuthorQuery);
    mysqli_stmt_bind_param($stmt, "i", $authorId);

    if (mysqli_stmt_execute($stmt)) {
        // JavaScript code to display a popup message
        echo '<script>
        
                alert("Author with ID ' . $authorId . ' is deleted successfully.");
                
                setTimeout(function() {
                    window.location.href = "./manageAuthors.php";
                }, 1000);
              </script>';
        exit();
    } else {
        echo "Error removing author: " . mysqli_error($conn);
    }



    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    echo "Invalid request method or author ID not provided";
}
?>