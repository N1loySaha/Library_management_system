<?php
include 'config.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract book information from the form
    $bookId = $_POST['book_id'];
    $bookTitle = $_POST['book_title'];
    $description = $_POST['description'];
    $language = $_POST['language'];
    $yearOfPublication = $_POST['yearOfPublication'];
    $numOfCopies = $_POST['numofcopy'];
    $coverPage = $_POST['cover_page'];

    // Update book details in the database
    $updateBookQuery = "UPDATE book SET book_name = ?, description = ?, language = ?, year_of_publication = ?, no_of_copies = ?, image_url = ? WHERE book_id = ?";
    $stmt_update_book = mysqli_prepare($conn, $updateBookQuery);
    mysqli_stmt_bind_param($stmt_update_book, "sssiisi", $bookTitle, $description, $language, $yearOfPublication, $numOfCopies, $coverPage, $bookId);
    mysqli_stmt_execute($stmt_update_book);

    // Check if new authors are added
    if (isset($_POST['a_first_name']) && isset($_POST['a_last_name'])) {
        $authorFirstNames = $_POST['a_first_name'];
        $authorLastNames = $_POST['a_last_name'];

        // Insert authors into the authors table and book_author relationship table
        foreach ($authorFirstNames as $index => $firstName) {
            $lastName = $authorLastNames[$index];
            // Check if author exists in the database
            $selectAuthorQuery = "SELECT author_id FROM author WHERE a_first_name = ? AND a_last_name = ?";
            $stmt_author = mysqli_prepare($conn, $selectAuthorQuery);
            mysqli_stmt_bind_param($stmt_author, "ss", $firstName, $lastName);
            mysqli_stmt_execute($stmt_author);
            mysqli_stmt_store_result($stmt_author);

            // If author does not exist, add the author to the authors table
            if (mysqli_stmt_num_rows($stmt_author) == 0) {
                $insertAuthorQuery = "INSERT INTO author (a_first_name, a_last_name) VALUES (?, ?)";
                $stmt_insert_author = mysqli_prepare($conn, $insertAuthorQuery);
                mysqli_stmt_bind_param($stmt_insert_author, "ss", $firstName, $lastName);
                mysqli_stmt_execute($stmt_insert_author);
                $authorId = mysqli_insert_id($conn); // stores the last inserted author_id in this variable
            } else {
                // If author already exists, retrieve the author_id
                mysqli_stmt_bind_result($stmt_author, $authorId);
                mysqli_stmt_fetch($stmt_author);
            }

            // Insert book-author relationship into the book_author table
            $insertRelationshipQuery = "INSERT INTO writes (book_id, author_id) VALUES (?, ?)";
            $stmt_relationship = mysqli_prepare($conn, $insertRelationshipQuery);
            mysqli_stmt_bind_param($stmt_relationship, "ii", $bookId, $authorId);
            mysqli_stmt_execute($stmt_relationship);
        }
    }

    echo "<script> alert('The book information is successfully updated.');
    setTimeout(function() {
        window.location.href = './manageBooks.php';
    }, 100);

    </script>";

    exit();
} else {
    echo "<script>
            alert('Invalid Request');
        </script>";
}
?>
