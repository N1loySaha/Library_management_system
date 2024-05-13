<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remove_authors'])) {
    $bookId = $_POST['book_id'];
    $removeAuthors = $_POST['remove_authors'];
    // echo $bookId . " " . $removeAuthors;

    foreach ($removeAuthors as $authorId) {
        $removeAuthorQuery = "DELETE FROM writes WHERE book_id = ? AND author_id = ?";
        $stmt_remove_author = mysqli_prepare($conn, $removeAuthorQuery);
        mysqli_stmt_bind_param($stmt_remove_author, "ii", $bookId, $authorId);
        if (mysqli_stmt_execute($stmt_remove_author)) {
            echo "Author with ID $authorId successfully removed from the book: $bookId.<br>";
        } else {
            echo "Error removing author with ID $authorId: " . mysqli_error($conn) . "<br>";
        }
        mysqli_stmt_close($stmt_remove_author);
    }

    echo "Authors successfully removed from the book.";
} else {
    echo "Invalid request.";
}

mysqli_close($conn);
?>
